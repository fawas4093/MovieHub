<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Modal Popup</title>
  <style>
    @import url("https://fonts.googleapis.com/css?family=Nunito:400,600,700");

    * {
      box-sizing: border-box;
    }

    body {
      font-family: "Nunito", sans-serif;
      color: rgba(#000, 0.7);
    }

    .container {
      height: 200vh;
      background-image: url(https://images.unsplash.com/photo-1538137524007-21e48fa42f3f?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=ac9fa0975bd2ebad7afd906c5a3a15ab&auto=format&fit=crop&w=1834&q=80);
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
    }

    .modal {
      position: fixed;
      left: 0;
      bottom: 0;
      width: 100%;
      height: 60px;
      background: rgba(#333, 0.5);
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      transition: 0.4s;
    }

    .modal-container {
      display: flex;
      max-width: 720px;
      width: 100%;
      border-radius: 10px;
      overflow: hidden;
      position: absolute;
      opacity: 0;
      pointer-events: none;
      transition-duration: 0.3s;
      background: #fff;
      transform: translateY(100px) scale(0.4);
    }

    .modal-title {
      font-size: 26px;
      margin: 0;
      font-weight: 400;
      color: #55311c;
    }

    .modal-desc {
      margin: 6px 0 30px 0;
    }

    .modal-left {
      padding: 60px 30px 20px;
      background: #fff;
      flex: 1.5;
      transition-duration: 0.5s;
      transform: translateY(80px);
      opacity: 0;
    }

    .modal-button {
      color: darken(#8c7569, 5%);
      font-family: "Nunito", sans-serif;
      font-size: 18px;
      cursor: pointer;
      border: 0;
      outline: 0;
      padding: 10px 40px;
      border-radius: 30px;
      background: rgb(255, 255, 255);
      box-shadow: 0 10px 40px rgba(0, 0, 0, 0.16);
      transition: 0.3s;
    }

    .modal-button:hover {
      border-color: rgba(255, 255, 255, 0.2);
      background: rgba(#fff, 0.8);
    }

    .modal-right {
      flex: 2;
      font-size: 0;
      transition: 0.3s;
      overflow: hidden;
    }

    .modal-right img {
      width: 100%;
      height: 100%;
      transform: scale(2);
      object-fit: cover;
      transition-duration: 1.2s;
    }

    .is-open {
      height: 100%;
      background: rgba(#333, 0.85);
    }

    .is-open .modal-container {
      opacity: 1;
      transition-duration: 0.6s;
      pointer-events: auto;
      transform: translateY(0) scale(1);
    }

    .is-open .modal-right img {
      transform: scale(1);
    }

    .is-open .modal-left {
      transform: translateY(0);
      opacity: 1;
      transition-delay: 0.1s;
    }

    .modal-buttons {
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .modal-buttons a {
      color: rgba(#333, 0.6);
      font-size: 14px;
    }

    .sign-up {
      margin: 60px 0 0;
      font-size: 14px;
      text-align: center;
    }

    .sign-up a {
      color: #8c7569;
    }

    .input-button {
      padding: 8px 12px;
      outline: none;
      border: 0;
      color: #fff;
      border-radius: 4px;
      background: #8c7569;
      font-family: "Nunito", sans-serif;
      transition: 0.3s;
      cursor: pointer;
    }

    .input-button:hover {
      background: #55311c;
    }

    .input-label {
      font-size: 11px;
      text-transform: uppercase;
      font-family: "Nunito", sans-serif;
      font-weight: 600;
      letter-spacing: 0.7px;
      color: #8c7569;
      transition: 0.3s;
    }

    .input-block {
      display: flex;
      flex-direction: column;
      padding: 10px 10px 8px;
      border: 1px solid #ddd;
      border-radius: 4px;
      margin-bottom: 20px;
      transition: 0.3s;
    }

    .input-block input {
      outline: 0;
      border: 0;
      padding: 4px 0 0;
      font-size: 14px;
      font-family: "Nunito", sans-serif;
    }

    .input-block input::placeholder {
      color: #ccc;
    }

    .input-block:focus-within {
      border-color: #8c7569;
    }

    .icon-button {
      outline: 0;
      position: absolute;
      right: 10px;
      top: 12px;
      width: 32px;
      height: 32px;
      border: 0;
      background: 0;
      padding: 0;
      cursor: pointer;
    }

    .scroll-down {
      position: fixed;
      top: 50%;
      left: 50%;
      display: flex;
      flex-direction: column;
      align-items: center;
      text-align: center;
      color: #8c7569;
      font-size: 32px;
      font-weight: 800;
      transform: translate(-50%, -50%);
    }

    .scroll-down svg {
      margin-top: 16px;
      width: 52px;
      fill: currentColor;
    }

    @media(max-width: 750px) {
      .modal-container {
        width: 90%;
      }

      .modal-right {
        display: none;
      }
    }

  </style>
</head>
<body>
  <div class="scroll-down">SCROLL DOWN
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32">
      <path d="M16 3C8.832031 3 3 8.832031 3 16s5.832031 13 13 13 13-5.832031 13-13S23.167969 3 16 3zm0 2c6.085938 0 11 4.914063 11 11 0 6.085938-4.914062 11-11 11-6.085937 0-11-4.914062-11-11C5 9.914063 9.914063 5 16 5zm-1 4v10.28125l-4-4-1.40625 1.4375L16 23.125l6.40625-6.40625L21 15.28125l-4 4V9z"/>
    </svg>
  </div>
  <div class="container"></div>
  <div class="modal">
    <div class="modal-container">
      <div class="modal-left">
        <h1 class="modal-title">Welcome!</h1>
        <p class="modal-desc">Fanny pack hexagon food truck, street art waistcoat kitsch.</p>
        <div class="input-block">
          <label for="email" class="input-label">Email</label>
          <input type="email" name="email" id="email" placeholder="Email">
        </div>
        <div class="input-block">
          <label for="password" class="input-label">Password</label>
          <input type="password" name="password" id="password" placeholder="Password">
        </div>
        <div class="modal-buttons">
          <a href="#">Forgot your password?</a>
          <button class="input-button">Login</button>
        </div>
        <p class="sign-up">Don't have an account? <a href="#">Sign up now</a></p>
      </div>
      <div class="modal-right">
        <img src="https://images.unsplash.com/photo-151248613
