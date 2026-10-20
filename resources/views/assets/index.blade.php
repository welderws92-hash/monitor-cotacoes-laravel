<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Cotações | MarketWatch Analytics</title>

    <style>
        * {
            box-sizing: border-box;
        }

        :root {
            --black: #090909;
            --panel: #171717;
            --panel-light: #202020;
            --gold: #D4AF37;
            --gold-light: #F1D675;
            --gold-border: #3A3020;
            --white: #F5F5F4;
            --muted: #A8A29E;
            --green: #22C55E;
            --red: #EF4444;
            --gray: #D4D4D4;
        }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: Arial, Helvetica, sans-serif;
            color: var(--white);
            background: var(--black);
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
            padding: 22px 5%;
            background: var(--panel);
            border-bottom: 1px solid var(--gold-border);
        }

        .brand h1 {
            margin: 0;
            color: var(--gold);
            font-size: 26px;
            letter-spacing: 0.5px;
        }

        .brand p {
            margin: 7px 0 0;
            color: var(--muted);
            font-size: 13px;
        }

        .logout-button {
            padding: 11px 17px;
            color: var(--black);
            background: var(--gold);
            border: 1px solid var(--gold);
            border-radius: 8px;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.2s, transform 0.2s;
        }

        .logout-button:hover {
            background: var(--gold-light);
            transform: translateY(-1px);
        }

        main {
            width: 90%;
            max-width: 1250px;
            margin: 38px auto;
        }

        .page-heading {
            margin-bottom: 28px;
        }

        .page-heading h2 {
            margin: 0 0 10px;
            color: var(--gold);
            font-size: 29px;
        }

        .page-heading p {
            margin: 0;
            color: var(--muted);
            line-height: 1.6;
        }

        .success {
            margin-bottom: 22px;
            padding: 14px 16px;
            color: #86EFAC;
            background: #14251A;
            border: 1px solid #225B35;
            border-radius: 8px;
        }

        .summary-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 18px;
            margin-bottom: 28px;
        }

        .summary-card {
            padding: 22px;
            background: var(--panel);
            border: 1px solid var(--gold-border);
            border-radius: 12px;
        }

        .summary-label {
            margin-bottom: 12px;
            color: var(--muted);
            font-size: 13px;
        }

        .summary-value {
            color: var(--gold);
            font-size: 27px;
            font-weight: bold;
        }

        .table-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            margin-bottom: 15px;
        }

        .table-header h3 {
            margin: 0;
            color: var(--gold);
            font-size: 19px;
        }

        .asset-count {
            color: var(--muted);
            font-size: 13px;
        }

        .table-container {
            overflow-x: auto;
            background: var(--panel);
            border: 1px solid var(--gold-border);
            border-radius: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            white-space: nowrap;
        }

        thead {
            background: #201B10;
        }

        th {
            padding: 17px 16px;
            color: var(--gold);
            font-size: 12px;
            font-weight: bold;
            text-align: left;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-bottom: 1px solid var(--gold-border);
        }

        td {
            padding: 17px 16px;
            color: var(--white);
            font-size: 14px;
            border-bottom: 1px solid #292929;
        }

        tbody tr {
            transition: background 0.2s;
        }

        tbody tr:hover {
            background: var(--panel-light);
        }

        tbody tr:last-child td {
            border-bottom: none;
        }

        .asset-code {
            color: var(--green);
            font-weight: bold;
            letter-spacing: 0.3px;
        }

        .asset-name {
            color: var(--white);
            font-weight: 500;
        }

        .asset-type {
            color: var(--muted);
        }

        .price {
            font-weight: bold;
            font-variant-numeric: tabular-nums;
        }

        .positive {
            color: var(--green);
        }

        .negative {
            color: var(--red);
        }

        .neutral {
            color: var(--gray);
        }

        .variation-badge {
            display: inline-block;
            padding: 6px 9px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: bold;
        }

        .variation-badge.positive {
            color: var(--green);
            background: rgba(34, 197, 94, 0.10);
        }

        .variation-badge.negative {
            color: var(--red);
            background: rgba(239, 68, 68, 0.10);
        }

        .variation-badge.neutral {
            color: var(--gray);
            background: rgba(212, 212, 212, 0.08);
        }

        .empty {
            padding: 38px 20px;
            color: var(--muted);
            text-align: center;
        }

        footer {
            padding: 24px;
            color: var(--muted);
            font-size: 12px;
            text-align: center;
        }

        @media (max-width: 850px) {
            .summary-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 600px) {
            header {
                align-items: flex-start;
                flex-direction: column;
                padding: 20px 5%;
            }

            main {
                width: 94%;
                margin: 28px auto;
            }

            .page-heading h2 {
                font-size: 24px;
            }

            .summary-grid {
                grid-template-columns: 1fr;
                gap: 12px;
            }

            .summary-card {
                padding: 18px;
            }

            .summary-value {
                font-size: 24px;
            }

            th,
            td {
                padding: 14px 12px;
            }
        }
    </style>
</head>

<body>
    <header>
        <div class="brand">
            <h1>MarketWatch</h1>
            <p>ANALYTICS DE COTAÇÕES E ALERTAS DE PREÇOS</p>
        </div>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button class="logout-button" type="submit">
                Sair da conta
            </button>
        </form>
    </header>

    <main>
        <section class="page-heading">
            <h2>Mercado de cotações</h2>
            <p>
                Acompanhe os preços e as variações dos ativos cadastrados.
            </p>
        </section>

        @if (session('success'))
            <div class="success" role="status">
                {{ session('success') }}
            </div>
        @endif

        @php
            $totalAssets = $assets->count();

            $gainers = $assets->filter(
                fn($asset) => (float) $asset->variation_24h > 0
            )->count();

            $losers = $assets->filter(
                fn($asset) => (float) $asset->variation_24h < 0
            )->count();
        @endphp

        <section class="summary-grid">
            <div class="summary-card">
                <div class="summary-label">Ativos cadastrados</div>
                <div class="summary-value">{{ $totalAssets }}</div>
            </div>

            <div class="summary-card">
                <div class="summary-label">Em alta nas últimas 24h</div>
                <div class="summary-value positive">{{ $gainers }}</div>
            </div>

            <div class="summary-card">
                <div class="summary-label">Em baixa nas últimas 24h</div>
                <div class="summary-value negative">{{ $losers }}</div>
            </div>
        </section>

        <section>
            <div class="table-header">
                <h3>Ativos do mercado</h3>

                <span class="asset-count">
                    {{ $totalAssets }} ativo(s)
                </span>
            </div>

            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Moeda</th>
                            <th>Nome</th>
                            <th>Tipo</th>
                            <th>Preço atual</th>
                            <th>Máxima 24h</th>
                            <th>Mínima 24h</th>
                            <th>Variação 24h</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($assets as $asset)
                            @php
                                $variation = (float) $asset->variation_24h;

                                $variationClass = $variation > 0
                                    ? 'positive'
                                    : ($variation < 0 ? 'negative' : 'neutral');
                            @endphp

                            <tr>
                                <td class="asset-code">
                                    {{ $asset->code }}
                                </td>

                                <td class="asset-name">
                                    {{ $asset->name }}
                                </td>

                                <td class="asset-type">
                                    {{ $asset->type }}
                                </td>

                                <td class="price {{ $variationClass }}">
                                    {{ $asset->symbol }}
                                    {{ number_format((float) $asset->current_price, 4, ',', '.') }}
                                </td>

                                <td>
                                    {{ $asset->symbol }}
                                    {{ number_format((float) $asset->high_price, 4, ',', '.') }}
                                </td>

                                <td>
                                    {{ $asset->symbol }}
                                    {{ number_format((float) $asset->low_price, 4, ',', '.') }}
                                </td>

                                <td>
                                    <span class="variation-badge {{ $variationClass }}">
                                        {{ $variation > 0 ? '+' : '' }}{{ number_format($variation, 2, ',', '.') }}%
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="empty">
                                    Nenhum ativo cadastrado ainda.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>
    </main>

    <footer>
        MarketWatch Analytics &copy; {{ date('Y') }}
        — Monitoramento de cotações
    </footer>
</body>

</html>