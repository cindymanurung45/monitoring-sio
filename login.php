<form name="form1" method="post" action="ceklogin.php">
<html>
 <head>
  <title>
   Form Login
  </title>
  <style>
   body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
            position: relative;
            overflow: hidden;
            background-color: #2f6f2f;
        }
        body::before {
            content: "";
            position: absolute;
            inset: 0;
            background-image: url('https://storage.googleapis.com/a1aa/image/c43739bb-d08f-4a3d-c014-9884f0cc90c7.jpg');
            background-size: cover;
            background-position: center;
            opacity: 0.25;
            z-index: 0;
        }
        .form-container {
            background: white;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 320px;
            position: relative;
            z-index: 1;
            text-align: center;
        }
        .form-container h2 {
            margin-bottom: 20px;
        }
        .form-container img {
            width: 100%;
            border-radius: 10px;
            margin-bottom: 20px;
            object-fit: cover;
            height: 150px;
        }
        .form-container input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .form-container .submit-button {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            background: linear-gradient(to right, #1e4d1e, #27a627);
            color: white;
            font-size: 16px;
            cursor: pointer;
        }
        .form-container1 {            
            background: white;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 300px;
            margin: 0 auto 10px auto;
        }
  </style>
 </head>
 <body>
  <div class="form-container">
   <h2>
    LOGIN
   </h2>
   <img alt="Green palm oil plantation with rows of palm trees under bright blue sky with sunlight" height="150" src="https://storage.googleapis.com/a1aa/image/c43739bb-d08f-4a3d-c014-9884f0cc90c7.jpg" width="320"/>
   <input id="t1" name="t1" placeholder="Masukan User" type="user"/>
   <span class="form-container1">
    <input id="t2" name="t2" placeholder="Masukan Password" type="password"/>
   </span>
   <button class="submit-button">
 Login</a>
   </button>
  </div>
 </body>
</html>