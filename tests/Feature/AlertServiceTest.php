<?php

namespace Tests\Feature;

use App\Mail\PriceAlertTriggered;
use App\Models\Asset;
use App\Models\PriceAlert;
use App\Models\User;
use App\Services\AlertService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class AlertServiceTest extends TestCase
{
    use RefreshDatabase;

    private function createAsset(float $price): Asset
    {
        return Asset::create([
            'code' => 'USD',
            'name' => 'Dólar Americano',
            'type' => 'currency',
            'symbol' => 'US$',
            'current_price' => $price,
        ]);
    }

    private function createAlert(
        User $user,
        Asset $asset,
        string $condition,
        float $targetPrice,
        bool $isTriggered = false,
    ): PriceAlert {
        return PriceAlert::create([
            'user_id' => $user->id,
            'asset_id' => $asset->id,
            'condition' => $condition,
            'target_price' => $targetPrice,
            'is_triggered' => $isTriggered,
        ]);
    }

    public function test_alert_above_is_triggered_when_price_reaches_target(): void
    {
        Mail::fake();

        $user = User::factory()->create();
        $asset = $this->createAsset(5.50);

        $alert = $this->createAlert($user, $asset, 'above', 5.50);

        $count = app(AlertService::class)->checkAlerts();

        $this->assertSame(1, $count);

        $this->assertDatabaseHas('price_alerts', [
            'id' => $alert->id,
            'is_triggered' => true,
        ]);

        $this->assertNotNull($alert->fresh()->triggered_at);

        Mail::assertSent(PriceAlertTriggered::class, 1);
    }

    public function test_alert_below_is_triggered_when_price_falls_below_target(): void
    {
        Mail::fake();

        $user = User::factory()->create();
        $asset = $this->createAsset(5.00);

        $alert = $this->createAlert($user, $asset, 'below', 5.50);

        $count = app(AlertService::class)->checkAlerts();

        $this->assertSame(1, $count);

        $this->assertDatabaseHas('price_alerts', [
            'id' => $alert->id,
            'is_triggered' => true,
        ]);

        Mail::assertSent(PriceAlertTriggered::class, 1);
    }

    public function test_alert_is_not_triggered_when_condition_is_not_met(): void
    {
        Mail::fake();

        $user = User::factory()->create();
        $asset = $this->createAsset(5.00);

        $alert = $this->createAlert($user, $asset, 'above', 5.50);

        $count = app(AlertService::class)->checkAlerts();

        $this->assertSame(0, $count);

        $this->assertDatabaseHas('price_alerts', [
            'id' => $alert->id,
            'is_triggered' => false,
        ]);

        Mail::assertNothingSent();
    }

    public function test_already_triggered_alert_is_not_sent_again(): void
    {
        Mail::fake();

        $user = User::factory()->create();
        $asset = $this->createAsset(6.00);

        $alert = $this->createAlert(
            $user,
            $asset,
            'above',
            5.50,
            true,
        );

        $count = app(AlertService::class)->checkAlerts();

        $this->assertSame(0, $count);

        Mail::assertNothingSent();
    }
}
