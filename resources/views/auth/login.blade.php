<!DOCTYPE html>
<html>

<head>
    <title>Secure Portal - Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
    body {
        margin: 0;
        height: 100vh;
        background: #0f2027;
        overflow: hidden;
        display: flex;
        align-items: center;
    }

    /* Floating particles */
    body::before {
        content: "";
        position: absolute;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 2px, transparent 2px);
        background-size: 60px 60px;
        animation: moveParticles 60s linear infinite;
    }

    @keyframes moveParticles {
        from {
            transform: translate(0, 0);
        }

        to {
            transform: translate(-500px, -500px);
        }
    }

    .glass-card {
        position: relative;
        z-index: 2;
        background: rgba(255, 255, 255, 0.05);
        backdrop-filter: blur(15px);
        border-radius: 15px;
        border: 1px solid rgba(255, 255, 255, 0.1);
        color: white;
    }

    .lock-icon {
        animation: pulse 2s infinite;
    }

    @keyframes pulse {
        0% {
            transform: scale(1);
            opacity: 0.7;
        }

        50% {
            transform: scale(1.2);
            opacity: 1;
        }

        100% {
            transform: scale(1);
            opacity: 0.7;
        }
    }

    .glass-card {
        position: relative;
        z-index: 2;
        background: rgba(255, 255, 255, 0.05);
        backdrop-filter: blur(15px);
        border-radius: 20px;
        border: 1px solid rgba(255, 255, 255, 0.1);
        color: white;

        /* Entrance Animation */
        opacity: 0;
        transform: translateY(-50px);
        animation: cardEnter 1s forwards ease-out;
    }

    @keyframes cardEnter {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    </style>

</head>

<body>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">

                <div class="card glass-card shadow-lg">
                    <div class="card-body p-4">

                        <h4 class="text-center mb-4">🔐 Secure Portal</h4>

                        @if($errors->any())
                        <div class="alert alert-danger">
                            {{ $errors->first() }}
                        </div>
                        @endif
                        <div class="text-center mb-3">
                            <i class="fa-solid fa-lock fa-3x text-white lock-icon"></i>
                        </div>
                        <form method="POST" action="/login">
                            @csrf

                            <div class="mb-3">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control" placeholder="Enter your email"
                                    required>
                            </div>

                            <div class="mb-3">
                                <label>Password</label>
                                <input type="password" name="password" class="form-control"
                                    placeholder="Enter your password" required>
                            </div>

                            <button type="submit" class="btn btn-dark w-100" id="loginBtn">
                                <span class="btn-text">Login</span>
                                <span class="spinner-border spinner-border-sm d-none" role="status"
                                    aria-hidden="true"></span>
                            </button>

                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>
<script>
const form = document.querySelector('form');
const btn = document.getElementById('loginBtn');
form.addEventListener('submit', function(){
    btn.querySelector('.btn-text').classList.add('d-none');
    btn.querySelector('.spinner-border').classList.remove('d-none');
});
</script>
</body>

</html>