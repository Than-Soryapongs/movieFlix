<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
    <style>
        body {
            background-color: #000;
            color: #fff;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .container {
            background-color: #111;
            padding: 2.5rem 3rem;
            border-radius: 10px;
            box-shadow: 0 0 15px #dc3545cc;
            width: 100%;
            max-width: 450px;
        }
        h2 {
            color: #dc3545;
            margin-bottom: 1.5rem;
            font-weight: 700;
            text-align: center;
            letter-spacing: 1.2px;
        }
        .form-label {
            color: #ff6b6b;
            font-weight: 600;
        }
        .form-control {
            background-color: #222;
            border: 1.5px solid #dc3545;
            color: #fff;
            padding-left: 2.5rem;
            transition: border-color 0.3s, box-shadow 0.3s;
        }
        .form-control::placeholder {
            color: #ff7b7b;
            opacity: 1;
        }
        .form-control:focus {
            background-color: #2a2a2a;
            border-color: #ff4d4d;
            box-shadow: 0 0 8px #ff4d4d;
            color: #fff;
            outline: none;
        }
        .input-icon {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #dc3545;
            font-size: 1.2rem;
            pointer-events: none;
        }
        .position-relative {
            position: relative;
        }
        #error-msg {
            font-weight: 600;
            text-align: center;
            color: #ff4d4d;
        }
        button.btn-primary {
            background-color: #dc3545;
            border-color: #dc3545;
            font-weight: 700;
            width: 100%;
            transition: background-color 0.3s ease;
        }
        button.btn-primary:hover {
            background-color: #b02a37;
            border-color: #b02a37;
        }
        a.btn-link {
            color: #dc3545;
            display: block;
            text-align: center;
            margin-top: 1rem;
            font-weight: 600;
            text-decoration: none;
            transition: color 0.3s;
        }
        a.btn-link:hover {
            color: #ff6b6b;
            text-decoration: underline;
        }
    </style>
</head>
<body>
<div class="container col-md-6">
    <h2>Register</h2>
    <form method="POST" action="/register" onsubmit="return validatePasswords()">
        @csrf
        <div class="mb-3 position-relative">
            <label class="form-label" for="name">Name</label>
            <i class="bi bi-person input-icon"></i>
            <input type="text" id="name" name="name" class="form-control" placeholder="Your full name" required>
        </div>

        <div class="mb-3 position-relative">
            <label class="form-label" for="email">Email</label>
            <i class="bi bi-envelope input-icon"></i>
            <input type="email" id="email" name="email" class="form-control" placeholder="you@example.com" autocomplete="username" required>
        </div>

        <div class="mb-3 position-relative">
            <label class="form-label" for="password">Password</label>
            <i class="bi bi-lock input-icon"></i>
            <input type="password" id="password" name="password" class="form-control" placeholder="Enter password" autocomplete="new-password" required>
        </div>

        <div class="mb-3 position-relative">
            <label class="form-label" for="confirmPassword">Confirm Password</label>
            <i class="bi bi-lock-fill input-icon"></i>
            <input type="password" id="confirmPassword" name="confirm_password" class="form-control" placeholder="Re-enter password" autocomplete="new-password" required>
        </div>

        <div id="error-msg" style="display:none;">Passwords do not match.</div>

        <button type="submit" class="btn btn-primary">Register</button>
        <a href="/login" class="btn-link">Already have an account?</a>
    </form>
</div>

<script>
    function validatePasswords() {
        const password = document.getElementById('password').value.trim();
        const confirmPassword = document.getElementById('confirmPassword').value.trim();
        const errorMsg = document.getElementById('error-msg');

        if (password !== confirmPassword) {
            errorMsg.style.display = 'block';
            return false; // Prevent form submission
        }

        errorMsg.style.display = 'none';
        return true; // Allow form submission
    }
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
