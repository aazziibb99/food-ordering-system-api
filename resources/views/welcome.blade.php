<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form>
        <input type="text" id="email">
        <input type="text" id="password">
        <button>Sign In</button>
    </form>
    <script>
        document.querySelector("form").addEventListener("submit", (e) => {
            e.preventDefault();
            fetch("/api/sign-in", {
                method: "POST",
                credentials: "include",
                headers: {
                    "Content-Type": "application/json",
                    "Accept": "application/json",
                },
                body: JSON.stringify({
                    email: document.querySelector("#email").value,
                    password: document.querySelector("#password").value,
                }),
            })
            .then(response => response.json())
            .then(data => console.log(data))
        })
    </script>
</body>
</html>