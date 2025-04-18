<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Splash</title>
  <style>
    body {
      margin: 0;
      background-color: #fff;
      color: black;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      flex-direction: column;
    }
    img {
      width: 150px;
      height: auto;
      margin-bottom: 20px;
    }
    .fade-in {
      animation: fadeIn 2s ease-in-out;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: scale(0.9); }
      to { opacity: 1; transform: scale(1); }
    }
  </style>
</head>
<body>
  <img src="{{ asset('images/image.png') }}" alt="Logo" class="fade-in" />

  <audio id="introAudio" autoplay>
    <source src="{{ asset('audio/intro.mp4') }}" type="audio/mpeg">
    Browser tidak mendukung audio.
  </audio>

  <script>
    const audio = document.getElementById("introAudio");
    document.addEventListener("click", () => {
      audio.play();
    }, { once: true });
    setTimeout(() => {
      window.location.href = "{{ route('login') }}";
    }, 4000);
  </script>
</body>
</html>
