<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Entrar | MarketWatch Analytics</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
            font-family: Arial, sans-serif;
            color: #f1f5f9;
            background: #0f172a;
        }

        .login-card {
            width: 100%;
            max-width: 420px;
            padding: 36px;
            background: #1e293b;
            border: 1px solid #334155;
            border-radius: 16px;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.25);
        }

        .brand {
            margin-bottom: 30px;
            text-align: center;
        }

        .brand h1 {
            margin: 0 0 10px;
            color: #38bdf8;
            font-size: 27px;
        }

        .brand p {
            margin: 0;
            color: #94a3b8;
            line-height: 1.5;
        }

        .field {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-size: 14px;
            font-weight: bold;
        }

        input {
            width: 100%;
            padding: 13px 14px;
            color: #f8fafc;
            background: #0f172a;
            border: 1px solid #475569;
            border-radius: 8px;
            font-size: 15px;
        }

        input:focus {
            outline: 2px solid #38bdf8;
            border-color: transparent;
        }

        .error {
            margin-top: 7px;
            color: #fca5a5;
            font-size: 13px;
        }

        .success {
            margin-bottom: 20px;
            padding: 12px;
            color: #bbf7d0;
            background: #14532d;
            border-radius: 8px;
            font-size: 14px;
        }

        .button {
            width: 100%;
            padding: 14px;
            color: #082f49;
            background: #38bdf8;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
        }

        .button:hover {
            background: #7dd3fc;
        }

        .footer {
            margin-top: 24px;
            color: #cbd5e1;
            text-align: center;
            font-size: 14px;
        }

        .footer a {
            color: #38bdf8;
            text-decoration: none;
        }

        .footer a:hover {
            text-decoration: underline;
        }

        @media (max-width: 480px) {
            .login-card {
                padding: 26px 20px;
            }
        }
    </style>
</head>

<body>
    <main class="login-card">
        <header class="brand">
            <h1>MarketWatch</h1>
            <p>Analytics de cotações e alertas de preços</p>
        </header>

        <h2>Entrar na sua conta</h2>

        @if (session('success'))
            <div class="success">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="error" role="alert">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('login.store') }}">
            @csrf

            <div class="field">
                <label for="email">E-mail</label>

                <input
                    id="email"
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    placeholder="voce@exemplo.com"
                    autocomplete="email"
                    required
                    autofocus
                >

                @error('email')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="field">
                <label for="password">Senha</label>

                <input
                    id="password"
                    type="password"
                    name="password"
                    placeholder="Digite sua senha"
                    autocomplete="current-password"
                    required
                >

                @error('password')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <button class="button" type="submit">
                Entrar
            </button>
        </form>

        <footer class="footer">
            Ainda não tem conta?
            <a href="{{ route('register') }}">Criar cadastro</a>
        </footer>
    </main>
</body>
</html>