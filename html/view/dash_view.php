<?php

include_once "../config.php";
include_once __DIR__."../model/dash_model.php";
if (!isset($_SESSION['user'])) {

    header('Location : ' . site_root . 'login');
    die();
}
$obj = new  dash_model();
function is_adm(): bool
{$obj2 = new  dash_model();
    return $obj2->get_user_ac($_SESSION['user']) === 'admin';
}

?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        #dr-bt{
            width: 90px;
            height: 30px;
        }
        @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap");

        * {
            outline: none;
            box-sizing: border-box;
        }

        :root {
            --theme-bg-color: rgba(16 18 27 / 40%);
            --border-color: rgba(113 119 144 / 25%);
            --theme-color: #f9fafb;
            --inactive-color: rgb(113 119 144 / 78%);
            --body-font: "Poppins", sans-serif;
            --hover-menu-bg: rgba(12 15 25 / 30%);
            --content-title-color: #999ba5;
            --content-bg: rgb(146 151 179 / 13%);
            --button-inactive: rgb(249 250 251 / 55%);
            --dropdown-bg: #21242d;
            --dropdown-hover: rgb(42 46 60);
            --popup-bg: rgb(22 25 37);
            --search-bg: #14162b;
            --overlay-bg: rgba(36, 39, 59, 0.3);
            --scrollbar-bg: rgb(1 2 3 / 40%);
        }

        .light-mode {
            --theme-bg-color: rgb(255 255 255 / 31%);
            --theme-color: #3c3a3a;
            --inactive-color: #333333;
            --button-inactive: #3c3a3a;
            --search-bg: rgb(255 255 255 / 31%);
            --dropdown-bg: #f7f7f7;
            --overlay-bg: rgb(255 255 255 / 30%);
            --dropdown-hover: rgb(236 236 236);
            --border-color: rgb(255 255 255 / 35%);
            --popup-bg: rgb(255 255 255);
            --hover-menu-bg: rgba(255 255 255 / 35%);
            --scrollbar-bg: rgb(255 253 253 / 57%);
            --content-title-color: --theme-color;
        }

        html {
            box-sizing: border-box;
            -webkit-font-smoothing: antialiased;
        }

        body {
            font-family: var(--body-font);
            background-image: url(https://wallpapershome.com/images/wallpapers/macos-big-sur-1280x720-dark-wwdc-2020-22655.jpg);
            background-size: cover;
            background-position: center;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            padding: 2em;
            width: 100%;
            height: 100vh;
            overflow: hidden;
        }

        .light-mode .fa-linkedin-in {
            color: #222;
        }

        #Layer_1 {
            fill: #fff;
        }

        .light-mode #Layer_1 {
            fill: #222;
        }

        @media screen and (max-width: 480px) {
            body {
                padding: 0.8em;
            }
        }

        .video-bg {
            position: fixed;
            right: 0;
            top: 0;
            width: 100%;
            height: 100%;
        }

        .video-bg video {
            width: 100%;
            height: 100%;
            -o-object-fit: cover;
            object-fit: cover;
        }

        img {
            max-width: 100%;
        }

        .dark-light {
            position: fixed;
            bottom: 50px;
            right: 30px;
            background-color: var(--dropdown-bg);
            box-shadow: -1px 3px 8px -1px rgba(0, 0, 0, 0.2);
            padding: 8px;
            border-radius: 50%;
            z-index: 3;
            cursor: pointer;
        }

        .dark-light svg {
            width: 24px;
            flex-shrink: 0;
            fill: #ffce45;
            stroke: #ffce45;
            transition: 0.5s;
        }

        .light-mode .dark-light svg {
            fill: transparent;
            stroke: var(--theme-color);
        }

        .light-mode .profile-img {
            border: 2px solid var(--theme-bg-color);
            cursor: pointer;
        }

        .profile-img {
            cursor: pointer;
        }

        .light-mode .content-section ul {
            background-color: var(--theme-bg-color);
        }

        .light-mode .pop-up__title {
            border-color: var(--theme-color);
        }

        .light-mode .dropdown.is-active ul {
            background-color: rgba(255, 255, 255, 0.94);
        }

        body.light-mode:before,
        body.light-mode .video-bg:before {
            content: "";
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            height: 100vh;
            background: linear-gradient(
                    180deg,
                    rgba(255, 255, 255, 0.72) 0%,
                    rgba(255, 255, 255, 0.45) 100%
            );
            -webkit-backdrop-filter: saturate(3);
            backdrop-filter: saturate(3);
        }

        .app {
            background-color: var(--theme-bg-color);
            max-width: 1250px;
            max-height: 860px;
            height: 90vh;
            display: flex;
            flex-direction: column;
            overflow: hidden;
            position: relative;
            width: 100%;
            border-radius: 14px;
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            font-size: 15px;
            font-weight: 500;
        }

        .header {
            display: flex;
            align-items: center;
            flex-shrink: 0;
            height: 58px;
            width: 100%;
            border-bottom: 1px solid var(--border-color);
            padding: 0 30px;
            white-space: nowrap;
        }

        @media screen and (max-width: 480px) {
            .header {
                padding: 0 16px;
            }
        }

        .header-menu {
            display: flex;
            align-items: center;
        }

        .header-menu a {
            padding: 20px 30px;
            text-decoration: none;
            color: var(--inactive-color);
            border-bottom: 2px solid transparent;
            transition: 0.3s;
        }

        @media screen and (max-width: 610px) {
            .header-menu a:not(.main-header-link) {
                display: block;
            }
        }

        .header-menu a.is-active,
        .header-menu a:hover {
            color: var(--theme-color);
            border-bottom: 2px solid var(--theme-color);
        }

        .notify {
            position: relative;
        }

        .notify:before {
            content: "";
            position: absolute;
            background-color: #3a6df0;
            width: 6px;
            height: 6px;
            border-radius: 50%;
            right: 20px;
            top: 16px;
        }

        @media screen and (max-width: 1055px) {
            .notify {
                display: none;
            }
        }

        .menu-circle {
            width: 15px;
            height: 15px;
            background-color: #f96057;
            border-radius: 50%;
            box-shadow: 24px 0 0 0 #f8ce52, 48px 0 0 0 #5fcf65;
            margin-right: 195px;
            flex-shrink: 0;
        }

        @media screen and (max-width: 945px) {
            .menu-circle {
                display: none;
            }
        }

        .search-bar {
            height: 40px;
            display: flex;
            width: 100%;
            max-width: 400px;
            padding-left: 16px;
            border-radius: 4px;
        }

        .search-bar input {
            width: 100%;
            height: 100%;
            border: none;
            background-color: var(--search-bg);
            border-radius: 4px;
            font-family: var(--body-font);
            font-size: 15px;
            font-weight: 500;
            padding: 0 20px 0 40px;
            box-shadow: 0 0 0 2px rgba(134, 140, 160, 0.02);
            background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 56.966 56.966' fill='%23717790c7'%3e%3cpath d='M55.146 51.887L41.588 37.786A22.926 22.926 0 0046.984 23c0-12.682-10.318-23-23-23s-23 10.318-23 23 10.318 23 23 23c4.761 0 9.298-1.436 13.177-4.162l13.661 14.208c.571.593 1.339.92 2.162.92.779 0 1.518-.297 2.079-.837a3.004 3.004 0 00.083-4.242zM23.984 6c9.374 0 17 7.626 17 17s-7.626 17-17 17-17-7.626-17-17 7.626-17 17-17z'/%3e%3c/svg%3e");
            background-size: 14px;
            background-repeat: no-repeat;
            background-position: 16px 48%;
            color: var(--theme-color);
        }

        br {
            margin-top: 10px;
        }

        .search-bar input::-moz-placeholder {
            font-family: var(--body-font);
            color: var(--inactive-color);
            font-size: 15px;
            font-weight: 500;
        }

        .search-bar input:-ms-input-placeholder {
            font-family: var(--body-font);
            color: var(--inactive-color);
            font-size: 15px;
            font-weight: 500;
        }

        .search-bar input::placeholder {
            font-family: var(--body-font);
            color: var(--inactive-color);
            font-size: 15px;
            font-weight: 500;
        }

        .header-profile {
            display: flex;
            align-items: center;
            padding: 0 16px 0 40px;
            margin-left: auto;
            flex-shrink: 0;
        }

        .header-profile svg {
            width: 22px;
            color: #f9fafb;
            flex-shrink: 0;
        }

        .notification {
            position: relative;
        }

        .notification-number {
            position: absolute;
            background-color: #3a6df0;
            width: 16px;
            height: 16px;
            border-radius: 50%;
            font-size: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            right: -6px;
            top: -6px;
        }

        .notification + svg {
            margin-left: 22px;
        }

        @media screen and (max-width: 945px) {
            .notification + svg {
                display: none;
            }
        }

        .profile-img {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            -o-object-fit: cover;
            object-fit: cover;
            border: 2px solid var(--theme-color);
            margin-left: 22px;
        }

        .wide .header-menu,
        .wide .header-profile {
            display: none;
        }

        .wide .search-bar {
            max-width: 600px;
            margin: auto;
            transition: 0.4s;
            box-shadow: 0 0 0 1px var(--border-color);
            padding-left: 0;
        }

        .wide .menu-circle {
            margin-right: 0;
        }

        .wrapper {
            display: flex;
            flex-grow: 1;
            overflow: hidden;
        }

        .left-side {
            flex-basis: 240px;
            border-right: 1px solid var(--border-color);
            padding: 26px;
            overflow: auto;
            flex-shrink: 0;
        }

        @media screen and (max-width: 945px) {
            .left-side {
                display: none;
            }
        }

        .side-wrapper + .side-wrapper {
            margin-top: 20px;
        }

        .side-title {
            color: var(--inactive-color);
            margin-bottom: 14px;
        }

        .side-menu {
            display: flex;
            flex-direction: column;
            white-space: nowrap;
        }

        .side-menu a {
            text-decoration: none;
            color: var(--theme-color);
            display: flex;
            align-items: center;
            font-weight: 400;
            padding: 10px;
            font-size: 14px;
            border-radius: 6px;
            transition: 0.3s;
        }

        .ace {
            background-color: var(--hover-menu-bg);
        }

        .side-menu a:hover {
            background-color: var(--hover-menu-bg);
        }

        .side-menu svg {
            width: 16px;
            margin-right: 8px;
        }

        .updates {
            position: relative;
            top: 0;
            right: 0;
            margin-left: auto;
            width: 18px;
            height: 18px;
            font-size: 11px;
        }

        .main-header {
            display: flex;
            align-items: center;
            border-bottom: 1px solid var(--border-color);
            height: 58px;
            flex-shrink: 0;
        }

        .main-header .header-menu {
            margin-left: 150px;
        }

        @media screen and (max-width: 1055px) {
            .main-header .header-menu {
                margin: auto;
            }
        }

        .main-header .header-menu a {
            padding: 20px 24px;
        }

        .main-container {
            display: flex;
            flex-direction: column;
            flex-grow: 1;
        }

        .menu-link-main {
            text-decoration: none;
            color: var(--theme-color);
            padding: 0 30px;
        }

        @media screen and (max-width: 1055px) {
            .menu-link-main {
                display: none;
            }
        }

        .content-wrapper {
            display: flex;
            flex-direction: column;
            color: var(--theme-color);
            padding: 20px 40px;
            height: 100%;
            overflow: auto;
            background-color: var(--theme-bg-color);
        }

        @media screen and (max-width: 510px) {
            .content-wrapper {
                padding: 20px;
            }
        }

        .content-wrapper-header {
            display: flex;
            align-items: center;
            width: 100%;
            justify-content: space-between;
            background-image: url("https://www.transparenttextures.com/patterns/cubes.png"),
            linear-gradient(
                    to right top,
                    #cf4af3,
                    #e73bd7,
                    #f631bc,
                    #fd31a2,
                    #ff3a8b,
                    #ff4b78,
                    #ff5e68,
                    #ff705c,
                    #ff8c51,
                    #ffaa49,
                    #ffc848,
                    #ffe652
            );
            border-radius: 14px;
            padding: 20px 40px;
        }

        @media screen and (max-width: 415px) {
            .content-wrapper-header {
                padding: 20px;
            }
        }

        .content-wrapper.overlay {
            pointer-events: none;
            transition: 0.3s;
            background-color: var(--overlay-bg);
        }

        .overlay-app {
            width: 100%;
            height: 100%;
            position: fixed;
            left: 0;
            top: 0;
            pointer-events: all;
            background-color: rgba(36, 39, 59, 0.8);
            opacity: 0;
            visibility: hidden;

            transition: 0.3s;
        }

        .overlay-app.is-active {
            visibility: visible;
            opacity: 1;
        }

        .pu {
            color: #eee;
        }

        .img-content {
            font-weight: 500;
            font-size: 17px;
            display: flex;
            align-items: center;
            margin: 0;
        }

        .img-content svg {
            width: 28px;
            margin-right: 14px;
        }

        .content-text {
            font-weight: 400;
            font-size: 14px;
            margin-top: 16px;
            line-height: 1.7em;
            color: #ebecec;
            display: -webkit-box;
            -webkit-line-clamp: 4;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .content-wrapper-context {
            max-width: 350px;
        }

        .content-button {
            background-color: #3a6df0;
            border: none;
            padding: 8px 26px;
            color: #fff;
            border-radius: 20px;
            margin-top: 16px;
            cursor: pointer;
            transition: 0.3s;
            white-space: nowrap;
        }

        .content-wrapper-img {
            width: 186px;
            -o-object-fit: cover;
            object-fit: cover;
            margin-top: -25px;
            -o-object-position: center;
            object-position: center;
        }

        @media screen and (max-width: 570px) {
            .content-wrapper-img {
                width: 110px;
            }
        }

        .content-section {
            margin-top: 30px;
            display: flex;
            flex-direction: column;
        }

        .content-section-title {
            color: var(--content-title-color);
            margin-bottom: 14px;
        }

        .content-section ul {
            display: flex;
            flex-direction: column;
            width: 100%;
            height: 100%;
            justify-content: space-around;
            background-color: var(--content-bg);
            padding-left: 0;
            margin: 0;
            border-radius: 14px;
            border: 1px solid var(--theme-bg-color);
            cursor: pointer;
        }

        .content-section ul li {
            list-style: none;
            padding: 10px 18px;
            display: flex;
            align-items: center;
            font-size: 16px;
            width: 100%;
            height: 100%;
            white-space: nowrap;
            transition: 0.3s;
        }

        .content-section ul li:hover {
            background-color: var(--theme-bg-color);
        }

        .content-section ul li:hover:first-child {
            border-radius: 13px 13px 0 0;
        }

        .content-section ul li:hover:last-child {
            border-radius: 0 0 13px 13px;
        }

        .content-section ul li + li {
            border-top: 1px solid var(--border-color);
        }

        .content-section ul svg {
            width: 28px;
            border-radius: 6px;
            margin-right: 16px;
            flex-shrink: 0;
        }

        .products {
            display: flex;
            align-items: center;
            width: 150px;
        }

        @media screen and (max-width: 480px) {
            .products {
                width: 120px;
            }
        }

        .status {
            margin-left: auto;
            width: 140px;
            font-size: 15px;
            position: relative;
        }

        @media screen and (max-width: 700px) {
            .status {
                display: none;
            }
        }

        .status-circle {
            width: 6px;
            height: 6px;
            background-color: #396df0;
            position: absolute;
            border-radius: 50%;
            top: 4px;
            left: -20px;
        }

        .status-circle.green {
            background-color: #3bf083;
        }

        .status-button {
            font-size: 15px;
            margin-top: 0;
            padding: 6px 24px;
        }

        @media screen and (max-width: 390px) {
            .status-button {
                padding: 6px 14px;
            }
        }

        .status-button.open {
            background: none;
            color: var(--button-inactive);
            border: 1px solid var(--button-inactive);
        }

        .status-button:not(.open):hover {
            /*   color: #fff; */
            border-color: #fff;
        }

        .content-button:not(.open):hover {
            /*   background: #1e59f1; */
        }

        .menu {
            width: 5px;
            height: 5px;
            background-color: var(--button-inactive);
            border-radius: 50%;
            box-shadow: 7px 0 0 0 var(--button-inactive),
            14px 0 0 0 var(--button-inactive);
            margin: 0 12px;
        }

        @media screen and (max-width: 415px) {
            .adobe-product .menu {
                display: none;
            }
        }

        .dropdown {
            position: relative;
            height: 53px;
            width: 40px;
            top: -24px;
            display: flex;
            left: -5px;
            background: transparent;
            border: none;
            cursor: pointer;
        }

        .dropdown ul {
            position: absolute;
            background: var(--dropdown-bg);
            height: 110px;
            width: 120px;
            right: 0;
            top: 20px;
            pointer-events: none;
            opacity: 0;
            transform: translatey(10px);
            transition: all 0.4s ease;
        }

        .dropdown ul li a {
            text-decoration: none;
            color: var(--theme-color);
            font-size: 12px;
        }

        .dropdown.is-active ul {
            opacity: 1;
            pointer-events: all;
            transform: translatey(25px);
        }

        .dropdown.is-active ul li:hover {
            background-color: var(--dropdown-hover);
        }

        .button-wrapper {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            width: 187px;
            margin-left: auto;
        }

        @media screen and (max-width: 480px) {
            .button-wrapper {
                width: auto;
            }
        }

        .pop-up {
            position: absolute;
            padding: 30px 40px;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            overflow-y: auto;
            box-shadow: 0px 6px 30px rgba(0, 0, 0, 0.4);
            transition: all 0.3s;
            z-index: 10;
            background-color: var(--popup-bg);
            width: 500px;
            visibility: hidden;
            opacity: 0;
            border-radius: 6px;
            display: flex;
            flex-direction: column;
            white-space: normal;
        }

        @media screen and (max-width: 570px) {
            .pop-up {
                width: 100%;
            }
        }

        .pop-up.visible {
            visibility: visible;
            opacity: 1;
        }

        .pop-up__title {
            padding-bottom: 20px;
            border-bottom: 1px solid var(--border-color);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .pop-up__subtitle {
            white-space: normal;
            margin: 20px 0;
            font-size: 14px;
            font-weight: 400;
            line-height: 1.8em;
        }

        .pop-up__subtitle a {
            color: var(--theme-color);
        }

        .content-button-wrapper .content-button.status-button.open.close {
            width: auto;
        }

        .nvbd {
            background: transparent;
        }

        .content-section .close {
            margin-right: 0;
            width: 24px;
        }

        .checkbox-wrapper {
            display: flex;
            align-items: center;
            font-size: 14px;
            font-weight: 400;
        }

        .checkbox-wrapper + .checkbox-wrapper {
            margin: 20px 0 40px;
        }

        .checkbox {
            display: none;
        }

        .checkbox + label {
            display: flex;
            align-items: center;
        }

        .checkbox + label:before {
            content: "";
            margin-right: 10px;
            width: 15px;
            height: 15px;
            border: 1px solid var(--theme-color);
            border-radius: 4px;
            cursor: pointer;
            flex-shrink: 0;
        }

        .checkbox:checked + label:before {
            background-color: #3a6df0;
            border-color: #3a6df0;
            background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='%23fff' stroke-width='3' stroke-linecap='round' stroke-linejoin='round' class='feather feather-check'%3e%3cpath d='M20 6L9 17l-5-5'/%3e%3c/svg%3e");
            background-position: 50%;
            background-size: 12px;
            background-repeat: no-repeat;
        }

        .content-button-wrapper {
            margin-top: auto;
            margin-left: auto;
        }

        .content-button-wrapper .open {
            margin-right: 8px;
        }

        .apps-card {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            width: calc(100% + 20px);
        }

        .app-card {
            display: flex;
            flex-direction: column;
            width: calc(33.3% - 20px);
            font-size: 16px;
            background-color: var(--content-bg);
            border-radius: 14px;
            border: 1px solid var(--theme-bg-color);
            padding: 20px;
            cursor: pointer;
            transition: 0.3s ease;
        }

        .app-card:hover {
            transform: scale(1.02);
            background-color: var(--theme-bg-color);
        }

        .app-card svg {
            width: 28px;
            border-radius: 6px;
            margin-right: 12px;
            flex-shrink: 0;
        }

        .app-card + .app-card {
            margin-left: 20px;
        }

        .app-card span {
            display: flex;
            align-items: center;
        }

        .app-card__subtext {
            font-size: 14px;
            font-weight: 400;
            line-height: 1.6em;
            margin-top: 20px;
            border-bottom: 1px solid var(--border-color);
            padding-bottom: 20px;
        }

        .app-card-buttons {
            display: flex;
            align-items: center;
            margin-left: auto;
            margin-top: 16px;
        }

        @media screen and (max-width: 1110px) {
            .app-card {
                width: calc(50% - 20px);
            }

            .app-card:last-child {
                margin-top: 20px;
                margin-left: 0px;
            }
        }

        @media screen and (max-width: 565px) {
            .app-card {
                width: calc(100% - 20px);
                margin-top: 20px;
            }

            .app-card + .app-card {
                margin-left: 0;
            }
        }

        .content-wrapper {
            display: none;
        }

        ::-webkit-scrollbar {
            width: 6px;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb {
            background: var(--scrollbar-bg);
            border-radius: 10px;
        }

        .show {
            display: block;
        }

        .dr {
            position: relative;
        }

        .dr-con {
            color: white;
            position: absolute;
            font-size: 20px;
            transition: all 0.5s;
            /* display:flex;
            align-items:center; */

            min-width: 120px;
            right: -30px;
            display: none;
            /*   justify-content:center; */
        }

        .dr-con button {
            background: var(--theme-bg-color);
            color: #fff;
            display: block;
            border: none;
            border-bottom: 1.5px solid #aaa;
            transition: all 0.6s;
        }

        .btn___ {
            background: rgba(16 18 27 / 40%);
            color: #fff;
            display: block;
            border: none;

            transition: all 0.6s;
            height: 41px;
            width: 90px;
            border-radius: 50%;
            margin: 10px;
        }

        .btn___2 {
            background: rgba(16 18 27 / 40%);
            color: #fff;
            display: block;
            border: none;
            margin: 15px;
            transition: all 0.6s;
            height: 61px;
            width: 120px;
            border-radius: 50%;
            margin: 10px;
        }

        .btn___2:hover {
            background: rgba(16 18 27 / 70%);
        }

        .light-mode .btn___2 {
            background: rgba(250 250 250 / 50%);
            color: #444;
        }

        .light-mode .btn___2:hover {
            background: rgba(250 250 250 / 70%);
            color: #444;
        }

        .dr-bt {
        }

        .light-mode .dr-bt {
            color: #444;
        }

        .dr-con button:hover {
            background: rgba(16 18 27 / 60%);
        }

        .light-mode .dr-con button:hover {
            background: rgba(250, 250, 250, 0.7);
        }

        .light-mode .btn___ {
            color: #444;
        }

        .btn___:hover {
            background: rgba(16 18 27 / 60%);
        }

        .light-mode .btn___:hover {
            background: rgba(250, 250, 250, 0.7);
        }

        .dr-bt:first-child {
            border-radius: 10px 10px 0px 0px;
        }

        .dr-bt:last-child {
            border-radius: 0px 0px 10px 10px;
            border: none;
        }

        #col {
            color: white;
            margin: 5px;
            cursor: pointer;
        }

        .light-mode #col {
            color: #333;
            margin: 5px;
        }

        .nvbd:hover {
            background: rgba(16 18 27 / 40%);
        }

        .flex_row_ {
            display: flex;
           
            min-height: 370px;
        }
        .flex_row_{
              flex-wrap: wrap-reverse;
              padding-right:100px;
          }


        ._half {
            width: 50%;
            min-width: 320px;
            height: 100%;
        }

        ._half._inputss {
            padding-top: 70px;
        }

        ._align_center {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: -30px;
        }

        .prof {
            height: 250px;
            width: 250px;
            overflow: visible;
        }

        .prof img {
            height: 250px;
            width: 250px;
            border: 1px solid #fff;
            border-radius: 50%;
        }

        .avatar-upload {
            position: relative;
            max-width: 205px;
            margin: 90px auto;
        }
        @media screen and (max-width:989px){
            .avatar-upload {
                margin: 50px auto;
            }
        }

        .avatar-upload .avatar-edit {
            position: absolute;
            right: 12px;
            z-index: 1;
            top: 10px;
        }

        .avatar-upload .avatar-edit input {
            display: none;
        }

        .avatar-upload .avatar-edit input + label {
            display: inline-block;
            width: 34px;
            height: 34px;
            margin-bottom: 0;
            border-radius: 100%;
            background: #ffffff;
            border: 1px solid transparent;
            box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.12);
            cursor: pointer;
            font-weight: normal;
            transition: all 0.2s ease-in-out;
        }

        .avatar-upload .avatar-edit input + label:hover {
            background: #f1f1f1;
            border-color: #d6d6d6;
        }

        .avatar-upload .avatar-edit input + label:after {
            content: "\f040";
            font-family: "FontAwesome";
            color: #757575;
            position: absolute;
            top: 10px;
            left: 0;
            right: 0;
            text-align: center;
            margin: auto;
        }

        .avatar-upload .avatar-preview {
            width: 192px;
            height: 192px;
            position: relative;
            border-radius: 100%;
            border: 6px solid #f8f8f8;
            box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.1);
        }

        .avatar-upload .avatar-preview > div {
            width: 100%;
            height: 100%;
            border-radius: 100%;
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
        }

        @media screen and (max-width: 800px) {
            ._half._inputss {
                padding-top: 0px;
            }
        }

        .profilestat,
        .add_user_status,
        del_user_status,.change_status {
            display: none;
            background: red;
            width: 200px;
            min-height: 50px;
            font-size: 18px;
            text-align: center;
        }

    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script>
        $(document).ready(function(){

        $("#log_out_btn").click(function (){
            location.href='<?php echo site_root."dash/log_out"; ?>';
        });

            $(function () {
                $(".menu-link").click(function () {
                    $(".menu-link").removeClass("is-active");
                    $(this).addClass("is-active");
                });
            });
            $(function () {
                $(".main-header-link").click(function () {
                    $(".main-header-link").removeClass("is-active");
                    $(this).addClass("is-active");
                });
            });
            const dropdowns = document.querySelectorAll(".dropdown");
            dropdowns.forEach((dropdown) => {
                dropdown.addEventListener("click", (e) => {
                    e.stopPropagation();
                    dropdowns.forEach((c) => c.classList.remove("is-active"));
                    dropdown.classList.add("is-active");
                });
            });
            $("#search-bar input")
                .focus(function () {
                    $(".header").addClass("wide");
                })
                .blur(function () {
                    $(".header").removeClass("wide");
                });
            $(document).click(function (e) {
                var container = $(".status-button");
                var dd = $(".dropdown");
                if (!container.is(e.target) && container.has(e.target).length === 0) {
                    dd.removeClass("is-active");
                }
            });
            $(function () {
                $(".dropdown").on("click", function (e) {
                    $(".content-wrapper").addClass("overlay");
                    e.stopPropagation();
                });
                $(document).on("click", function (e) {
                    if ($(e.target).is(".dropdown") === false) {
                        $(".content-wrapper").removeClass("overlay");
                    }
                });
            });
            $(".content-button.status-button").click(function () {
                $(".pu").addClass("visible");
                $(".overlay-app").addClass("is-active");
            });
            $(".pu .close").click(function () {
                $(".pu").removeClass("visible");
                $(".overlay-app").removeClass("is-active");
            });
            const toggleButton = document.querySelector(".dark-light");
            toggleButton.addEventListener("click", () => {
                document.body.classList.toggle("light-mode");
                // document.querySelectorAll(".dr-bt").id.toggle("dr-bt");
                // if($(".dr-bt").css("background")!="rgba(250,250,250,0.7)"){
                //   $(".dr-bt").css("background","rgba(250,250,250,0.7)");
                //  $(".dr-bt").css("color","rgba(2,2,2,0.9)");
                // }else{
                // $(".dr-bt").css("background","rgba(11,11,11,0.7)");
                //  $(".dr-bt").css("color","rgba(210,21,211,0.9)");}
            });
            document.getElementById("op").addEventListener("click", function () {
                if (document.getElementById("les").style.display != "block") {
                    document.getElementById("les").style.display = "block";
                } else {
                    document.getElementById("les").style.display = "none";
                }
            });
            $(".main-header-link").click(function () {
                $(".side-menu a").removeClass("ace");
                let str = $(this).attr("id");
                str = str.substr(0, str.length - 1);
                $(".content-wrapper").css("display", "none");
                $("#" + str).css("display", "block");
            });
            $("#pro").click(function () {
                if ($(".dr-con").css("display") === "none") {
                    $(".dr-con").css("display", "block");
                } else {
                    $(".dr-con").css("display", "none");
                }
            });
            $(".side-menu a").click(function () {
                $(".side-menu a").removeClass("ace");
                $(this).addClass("ace");
            });
            $("#alll").click(function () {
                $(".main-header-link").removeClass("is-active");
                $(".main-header-link:first-child").addClass("is-active");
                $(".content-wrapper").css("display", "none");
                $(".show").css("display", "block");
            });
            $(".aa").click(function () {
                $(".main-header-link").removeClass("is-active");
                let str = $(this).attr("id");
                str = str + "_";
                $(".content-wrapper").css("display", "none");
                $("#" + str).css("display", "block");
            });

            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $("#imagePreview").css(
                            "background-image",
                            "url(" + e.target.result + ")"
                        );
                        $("#imagePreview").hide();
                        $("#imagePreview").fadeIn(650);
                    };
                    reader.readAsDataURL(input.files[0]);
                }
            }

            $("#imageUpload").change(function () {
                var input=document.querySelector('#imageUpload');
                var reader = new FileReader();
                reader.onload = function (e) {

                    $(".avatar-preview").css(
                        "background-image",
                        "url(" + e.target.result + ")"
                    );
                    $(".avatar-preview").hide();
                    $(".avatar-preview").fadeIn(650);
                };
                reader.readAsDataURL(input.files[0]);
                let fileInput = document.querySelector("#imageUpload");

                // Create a new form data instance and append the file to it
                let formData = new FormData();
                formData.append('file', fileInput.files[0]);

                // Send the file to the server with AJAX
                let xhr = new XMLHttpRequest();
                xhr.open('POST', "<?php echo site_root . "dash/profile_image"?>");
                xhr.send(formData);
                xhr.onreadystatechange = function () {
                    if (xhr.readyState == XMLHttpRequest.DONE) {
                        if (xhr.response.status === "ok") {
                            $(".profilestat").html(xhr.response.description);
                            $(".profilestat").css("backgroud", "rgba(21, 214, 82,0.7)");
                            $(".profilestat").css("display", "block");

                        } else {
                            $(".profilestat").html(xhr.response.description);
                            $(".profilestat").css("backgroud", "rgba(241, 23, 12,0.7)");
                            $(".profilestat").css("display", "block");
                        }
                    }

                }

            });
            <?php
            if(is_adm()){
                echo ' $("#add_user").click(
                function () {

                    $.get("'.site_root . 'dash/add_user"'.', {
            username_: $("#User_add_Name").val(),
                pass: $("#User_add_Pass").val(),
                acs: $("#User_add_Access").val()
        }, function (data) {
            if (data.status === "ok") {
                $(".add_user_status").html(data.description);
                $(".add_user_status").css("backgroud", "rgba(21, 214, 82,0.7)");
                $(".add_user_status").css("display", "block");

            } else {
                $(".add_user_status").html(data.description);
                $(".add_user_status").css("backgroud", "rgba(241, 23, 12,0.7)");
                $(".add_user_status").css("display", "block");
            }
        })
            .done(function (data) {
                if (data.status === "ok") {
                    $(".add_user_status").html(data.description);
                    $(".add_user_status").css("backgroud", "rgba(21, 214, 82,0.7)");
                    $(".add_user_status").css("display", "block");

                } else {
                    $(".add_user_status").html(data.description);
                    $(".add_user_status").css("backgroud", "rgba(241, 23, 12,0.7)");
                    $(".add_user_status").css("display", "block");
                }
            })
            .fail(function (jqxhr, settings, ex) {
                $(".add_user_status").html("error");
                $(".add_user_status").css("backgroud", "rgba(241, 23, 12,0.7)");
                $(".add_user_status").css("display", "block");
            });

        }
        )';
            }
            ?>

           <?php
            if(is_adm()){
                echo '$("#del_user").click(
                function () {
                    $.get("'.site_root . "dash/delete_user" .'", {username_: $("#User_del_Name").val()}, function (data) {
                        if (data.status === "ok") {
                            $(".del_user_status").html(data.description);
                            $(".del_user_status").css("backgroud", "rgba(21, 214, 82,0.7)");
                            $(".del_user_status").css("display", "block");

                        } else {
                            $(".del_user_status").html(data.description);
                            $(".del_user_status").css("backgroud", "rgba(241, 23, 12,0.7)");
                            $(".del_user_status").css("display", "block");
                        }
                    })
                        .done(function (data) {
                            if (data.status === "ok") {
                                $(".del_user_status").html(data.description);
                                $(".del_user_status").css("backgroud", "rgba(21, 214, 82,0.7)");
                                $(".del_user_status").css("display", "block");

                            } else {
                                $(".del_user_status").html(data.description);
                                $(".del_user_status").css("backgroud", "rgba(241, 23, 12,0.7)");
                                $(".del_user_status").css("display", "block");
                            }
                        })
                        .fail(function (jqxhr, settings, ex) {
                            $(".del_user_status").html("error");
                            $(".del_user_status").css("backgroud", "rgba(241, 23, 12,0.7)");
                            $(".del_user_status").css("display", "block");
                        });

                }
            )';
            }
            ?>

            $("#change_").click(
                function () {
                    $.get('<?php echo site_root . "dash/change" ?>', { username_: $("#User_change_Name").val(),
                        pass: $("#User_change_Pass").val(),
                        newpass: $("#User_change_New_Pass").val()}, function (data) {
                        if (data.status === "ok") {
                            $(".change_status").html(data.description);
                            $(".change_status").css("backgroud", "rgba(21, 214, 82,0.7)");
                            $(".change_status").css("display", "block");

                        } else {
                            $(".change_status").html(data.description);
                            $(".change_status").css("backgroud", "rgba(241, 23, 12,0.7)");
                            $(".change_status").css("display", "block");
                        }
                    })
                        .done(function (data) {
                            if (data.status === "ok") {
                                $(".change_status").html(data.description);
                                $(".change_status").css("backgroud", "rgba(21, 214, 82,0.7)");
                                $(".change_status").css("display", "block");

                            } else {
                                $(".change_status").html(data.description);
                                $(".change_status").css("backgroud", "rgba(241, 23, 12,0.7)");
                                $(".change_status").css("display", "block");
                            }
                        })
                        .fail(function (jqxhr, settings, ex) {
                            $(".del_user_status").html("error");
                            $(".del_user_status").css("backgroud", "rgba(241, 23, 12,0.7)");
                            $(".del_user_status").css("display", "block");
                        });

                }
            )})
    </script>
</head>
<body>
<div class="pop-up pu">
    <div class="pop-up__title">Log Out
        <svg class="close" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2"
             stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-circle">
            <circle cx="12" cy="12" r="10"/>
            <path d="M15 9l-6 6M9 9l6 6"/>
        </svg>
    </div>
    <div class="pop-up__subtitle">are you sure want to log out</div>
    <div class="checkbox-wrapper">
        <input type="checkbox" id="check1" class="checkbox">
        <label for="check1">I read privacy policy </label>
    </div>
    <div class="checkbox-wrapper">
        <input type="checkbox" id="check2" class="checkbox">
        <label for="check2">I want to log out</label>
    </div>
    <div class="content-button-wrapper">
        <button class="content-button status-button open close">Cancel</button>
        <button class="content-button status-button" id="log_out_btn">Continue</button>
    </div>
</div>
<div class="video-bg">
    <video width="320" height="240" autoplay loop muted>
        <source src="https://assets.codepen.io/3364143/7btrrd.mp4" type="video/mp4">
        Your browser does not support the video tag.
    </video>
</div>
<div class="dark-light">
    <svg viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" fill="none" stroke-linecap="round"
         stroke-linejoin="round">
        <path d="M21 12.79A9 9 0 1111.21 3 7 7 0 0021 12.79z"/>
    </svg>
</div>
<div class="app">
    <div class="header">
        <div class="menu-circle"></div>
        <div class="header-menu">
            <a class="menu-link is-active" href="#" id="op">Menu</a>

        </div>
        <div class="search-bar" id="search-bar">
            <input type="text" placeholder="Search">
        </div>
        <div class="header-profile">
            <div class="notification">
                <span class="notification-number">3</span>
                <svg viewBox="0 0 24 24" fill="currentColor" stroke="currentColor" stroke-width="2"
                     stroke-linecap="round" stroke-linejoin="round" class="feather feather-bell">
                    <path d="M18 8A6 6 0 006 8c0 7-3 9-3 9h18s-3-2-3-9M13.73 21a2 2 0 01-3.46 0"/>
                </svg>
            </div>
            <svg viewBox="0 0 512 512" fill="currentColor">
            </svg>
            <div class="dr">
        <span style="display:flex;" id="pro"><img class="profile-img"
                                                  src="https://images.unsplash.com/photo-1600353068440-6361ef3a86e8?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=1000&q=80"
                                                  alt=""><span id="col"> &downarrow;</span>
        </span>
                <div class="dr-con" id="dr-con">

                    <button class="dr-bt lig aa" id="m-side_144">profile setting</button>
                    <button class="content-button status-button dr-bt" id="dr-bt">logout</button>

                </div>
            </div>
        </div>
    </div>
    <div class="wrapper">
        <div class="left-side" id="les">
            <div class="side-wrapper">
                <div class="side-title">Download</div>
                <div class="side-menu">
                    <a href="#" id="alll">
                        <svg viewBox="0 0 512 512">
                            <g xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                                <path d="M0 0h128v128H0zm0 0M192 0h128v128H192zm0 0M384 0h128v128H384zm0 0M0 192h128v128H0zm0 0"
                                      data-original="#bfc9d1"/>
                            </g>
                            <path xmlns="http://www.w3.org/2000/svg" d="M192 192h128v128H192zm0 0" fill="currentColor"
                                  data-original="#82b1ff"/>
                            <path xmlns="http://www.w3.org/2000/svg"
                                  d="M384 192h128v128H384zm0 0M0 384h128v128H0zm0 0M192 384h128v128H192zm0 0M384 384h128v128H384zm0 0"
                                  fill="currentColor" data-original="#bfc9d1"/>
                        </svg>
                        All Apps
                    </a>
                    <a href="#" id="m-side_1" class="aa">
                        <svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg"
                             viewBox="0 0 102.17 122.88">
                            <path d="M102.17,29.66A3,3,0,0,0,100,26.79L73.62,1.1A3,3,0,0,0,71.31,0h-46a5.36,5.36,0,0,0-5.36,5.36V20.41H5.36A5.36,5.36,0,0,0,0,25.77v91.75a5.36,5.36,0,0,0,5.36,5.36H76.9a5.36,5.36,0,0,0,5.33-5.36v-15H96.82a5.36,5.36,0,0,0,5.33-5.36q0-33.73,0-67.45ZM25.91,20.41V6h42.4V30.24a3,3,0,0,0,3,3H96.18q0,31.62,0,63.24h-14l0-46.42a3,3,0,0,0-2.17-2.87L53.69,21.51a2.93,2.93,0,0,0-2.3-1.1ZM54.37,30.89,72.28,47.67H54.37V30.89ZM6,116.89V26.37h42.4V50.65a3,3,0,0,0,3,3H76.26q0,31.64,0,63.24ZM17.33,69.68a2.12,2.12,0,0,1,1.59-.74H54.07a2.14,2.14,0,0,1,1.6.73,2.54,2.54,0,0,1,.63,1.7,2.57,2.57,0,0,1-.64,1.7,2.16,2.16,0,0,1-1.59.74H18.92a2.15,2.15,0,0,1-1.6-.73,2.59,2.59,0,0,1,0-3.4Zm0,28.94a2.1,2.1,0,0,1,1.58-.74H63.87a2.12,2.12,0,0,1,1.59.74,2.57,2.57,0,0,1,.64,1.7,2.54,2.54,0,0,1-.63,1.7,2.14,2.14,0,0,1-1.6.73H18.94a2.13,2.13,0,0,1-1.59-.73,2.56,2.56,0,0,1,0-3.4ZM63.87,83.41a2.12,2.12,0,0,1,1.59.74,2.59,2.59,0,0,1,0,3.4,2.13,2.13,0,0,1-1.6.72H18.94a2.12,2.12,0,0,1-1.59-.72,2.55,2.55,0,0,1-.64-1.71,2.5,2.5,0,0,1,.65-1.69,2.1,2.1,0,0,1,1.58-.74ZM17.33,55.2a2.15,2.15,0,0,1,1.59-.73H39.71a2.13,2.13,0,0,1,1.6.72,2.61,2.61,0,0,1,0,3.41,2.15,2.15,0,0,1-1.59.73H18.92a2.14,2.14,0,0,1-1.6-.72,2.61,2.61,0,0,1,0-3.41Zm0-14.47A2.13,2.13,0,0,1,18.94,40H30.37a2.12,2.12,0,0,1,1.59.72,2.61,2.61,0,0,1,0,3.41,2.13,2.13,0,0,1-1.58.73H18.94a2.16,2.16,0,0,1-1.59-.72,2.57,2.57,0,0,1-.64-1.71,2.54,2.54,0,0,1,.65-1.7ZM74.3,10.48,92.21,27.26H74.3V10.48Z"/>
                        </svg>
                        Get Config file

                    </a>
                </div>
            </div>
            <div class="side-wrapper">
                <div class="side-title">users conteroll</div>
                <div class="side-menu">
                    <?php if (is_adm()) {
                        echo '<a href="#" id="m-side_2" class="aa">
                        <svg viewBox="0 0 512 512" fill="currentColor">
                            <circle cx="295.099" cy="327.254" r="110.96" transform="rotate(-45 295.062 327.332)"/>
                            <path d="M471.854 338.281V163.146H296.72v41.169a123.1 123.1 0 01121.339 122.939c0 3.717-.176 7.393-.5 11.027zM172.14 327.254a123.16 123.16 0 01100.59-120.915L195.082 73.786 40.146 338.281H172.64c-.325-3.634-.5-7.31-.5-11.027z"/>
                        </svg>
                        Add user
                    </a>';
                    } ?>

                    <?php if (is_adm()) {
                        echo '<a href="#" id="m-side_3" class="aa">
                                                    <svg viewBox="0 0 512 512" fill="currentColor">
                            <path d="M499.377 46.402c-8.014-8.006-18.662-12.485-29.985-12.613a41.13 41.13 0 00-.496-.003c-11.142 0-21.698 4.229-29.771 11.945L198.872 275.458c25.716 6.555 47.683 23.057 62.044 47.196a113.544 113.544 0 0110.453 23.179L500.06 106.661C507.759 98.604 512 88.031 512 76.89c0-11.507-4.478-22.33-12.623-30.488zM176.588 302.344a86.035 86.035 0 00-3.626-.076c-20.273 0-40.381 7.05-56.784 18.851-19.772 14.225-27.656 34.656-42.174 53.27C55.8 397.728 27.795 409.14 0 416.923c16.187 42.781 76.32 60.297 115.752 61.24 1.416.034 2.839.051 4.273.051 44.646 0 97.233-16.594 118.755-60.522 23.628-48.224-5.496-112.975-62.192-115.348z"/>
                        </svg>
    Delete user
    </a>';
                    } ?>


                    <a href="#" id="m-side_144" class="aa">
                        <svg viewBox="0 0 512 512" fill="currentColor">
                            <path d="M0 331v112.295a14.996 14.996 0 007.559 13.023L106 512V391L0 331zM136 391v121l105-60V331zM271 331v121l105 60V391zM406 391v121l98.441-55.682A14.995 14.995 0 00512 443.296V331l-106 60zM391 241l-115.754 57.876L391 365.026l116.754-66.15zM262.709 1.583a15.006 15.006 0 00-13.418 0L140.246 57.876 256 124.026l115.754-66.151L262.709 1.583zM136 90v124.955l105 52.5V150zM121 241L4.246 298.876 121 365.026l115.754-66.15zM271 150v117.455l105-52.5V90z"/>
                        </svg>
                        Your_self profile
                    </a>
                    <a href="#" id="m-side_5" class="content-button status-button close nvbd">
                        <svg viewBox="0 0 512 512" fill="currentColor">
                            <path d="M497 151H316c-8.401 0-15 6.599-15 15v300c0 8.401 6.599 15 15 15h181c8.401 0 15-6.599 15-15V166c0-8.401-6.599-15-15-15zm-76 270h-30c-8.401 0-15-6.599-15-15s6.599-15 15-15h30c8.401 0 15 6.599 15 15s-6.599 15-15 15zm0-180h-30c-8.401 0-15-6.599-15-15s6.599-15 15-15h30c8.401 0 15 6.599 15 15s-6.599 15-15 15z"/>
                            <path d="M15 331h196v60h-75c-8.291 0-15 6.709-15 15s6.709 15 15 15h135v-30h-30v-60h30V166c0-24.814 20.186-45 45-45h135V46c0-8.284-6.716-15-15-15H15C6.716 31 0 37.716 0 46v270c0 8.284 6.716 15 15 15z"/>
                        </svg>
                        Log out
                    </a>
                </div>
            </div>
            <div class="side-wrapper">
                <div class="side-title">Buy</div>
                <div class="side-menu">
                    <a href="#" id="m-side_6" class="aa">
                        <i class="fa-solid fa-cart-shopping"></i>&nbsp;
                        Buy
                    </a>

                </div>
            </div>
            <div class="side-wrapper">
                <div class="side-title">Links</div>
                <div class="side-menu">
                    <a href="#">
                        <i class="fa-brands fa-linkedin-in"></i>&nbsp;
                        Linkdin
                    </a>
                    <a href="#" id="m-side_8" class="aa">
                        <i class="fa-brands fa-telegram"></i>&nbsp;
                        Telegram
                    </a>
                    <a href="#">
                        <i class="fa-brands fa-instagram"></i>&nbsp;
                        Instagram
                    </a>

                </div>
            </div>
        </div>
        <div class="main-container">
            <div class="main-header">
                <a class="menu-link-main" href="#">Download</a>
                <div class="header-menu">
                    <a class="main-header-link is-active" href="#" id="_1_">Windows</a>
                    <a class="main-header-link" id="_2_" href="#">Linux</a>
                    <a class="main-header-link" id="_3_" href="#">Android</a>
                    <a class="main-header-link" id="_4_" href="#">ios</a>
                </div>
            </div>
            <div class="content-wrapper show" id="_1">
                <div class="content-wrapper-header">
                    <div class="content-wrapper-context">
                        <h3 class="img-content">
                            <svg viewBox="0 0 512 512">
                                <path d="M467 0H45C20.099 0 0 20.099 0 45v422c0 24.901 20.099 45 45 45h422c24.901 0 45-20.099 45-45V45c0-24.901-20.099-45-45-45z"
                                      fill="#d6355b" data-original="#ff468c"/>
                                <path xmlns="http://www.w3.org/2000/svg"
                                      d="M512 45v422c0 24.901-20.099 45-45 45H256V0h211c24.901 0 45 20.099 45 45z"
                                      fill="#d6355b" data-original="#d72878"/>
                                <path xmlns="http://www.w3.org/2000/svg"
                                      d="M467 30H45c-8.401 0-15 6.599-15 15v422c0 8.401 6.599 15 15 15h422c8.401 0 15-6.599 15-15V45c0-8.401-6.599-15-15-15z"
                                      fill="#2e000a" data-original="#700029"/>
                                <path xmlns="http://www.w3.org/2000/svg"
                                      d="M482 45v422c0 8.401-6.599 15-15 15H256V30h211c8.401 0 15 6.599 15 15z"
                                      fill="#2e000a" data-original="#4d0e06"/>
                                <path xmlns="http://www.w3.org/2000/svg"
                                      d="M181 391c-41.353 0-75-33.647-75-75 0-8.291 6.709-15 15-15s15 6.709 15 15c0 24.814 20.186 45 45 45s45-20.186 45-45-20.186-45-45-45c-41.353 0-75-33.647-75-75s33.647-75 75-75 75 33.647 75 75c0 8.291-6.709 15-15 15s-15-6.709-15-15c0-24.814-20.186-45-45-45s-45 20.186-45 45 20.186 45 45 45c41.353 0 75 33.647 75 75s-33.647 75-75 75z"
                                      fill="#d6355b" data-original="#ff468c"/>
                                <path xmlns="http://www.w3.org/2000/svg"
                                      d="M391 361h-30c-8.276 0-15-6.724-15-15V211h45c8.291 0 15-6.709 15-15s-6.709-15-15-15h-45v-45c0-8.291-6.709-15-15-15s-15 6.709-15 15v45h-15c-8.291 0-15 6.709-15 15s6.709 15 15 15h15v135c0 24.814 20.186 45 45 45h30c8.291 0 15-6.709 15-15s-6.709-15-15-15z"
                                      fill="#d6355b" data-original="#d72878"/>
                            </svg>
                            Adobe Stock
                        </h3>
                        <div class="content-text">Grab yourself 10 free images from Adobe Stock in a 30-day free trial
                            plan and find perfect image, that will help you with your new project.
                        </div>
                        <button class="content-button">Start free trial</button>
                    </div>
                    <img class="content-wrapper-img" src="https://assets.codepen.io/3364143/glass.png" alt="">
                </div>
                <div class="content-section">
                    <div class="content-section-title">Installed</div>
                    <ul>
                        <li class="adobe-product">
                            <div class="products">
                                <svg viewBox="0 0 52 52" style="border:1px solid #3291b8">
                                    <g xmlns="http://www.w3.org/2000/svg">
                                        <path d="M40.824 52H11.176C5.003 52 0 46.997 0 40.824V11.176C0 5.003 5.003 0 11.176 0h29.649C46.997 0 52 5.003 52 11.176v29.649C52 46.997 46.997 52 40.824 52z"
                                              fill="#061e26" data-original="#393687"/>
                                        <path d="M12.16 39H9.28V11h9.64c2.613 0 4.553.813 5.82 2.44 1.266 1.626 1.9 3.76 1.9 6.399 0 .934-.027 1.74-.08 2.42-.054.681-.22 1.534-.5 2.561-.28 1.026-.66 1.866-1.14 2.52-.48.654-1.213 1.227-2.2 1.72-.987.494-2.16.74-3.52.74h-7.04V39zm0-12h6.68c.96 0 1.773-.187 2.44-.56.666-.374 1.153-.773 1.46-1.2.306-.427.546-1.04.72-1.84.173-.801.267-1.4.28-1.801.013-.399.02-.973.02-1.72 0-4.053-1.694-6.08-5.08-6.08h-6.52V27zM29.48 33.92l2.8-.12c.106.987.6 1.754 1.48 2.3.88.547 1.893.82 3.04.82s2.14-.26 2.98-.78c.84-.52 1.26-1.266 1.26-2.239s-.36-1.747-1.08-2.32c-.72-.573-1.6-1.026-2.64-1.36-1.04-.333-2.086-.686-3.14-1.06a7.36 7.36 0 01-2.78-1.76c-.987-.934-1.48-2.073-1.48-3.42s.54-2.601 1.62-3.761 2.833-1.739 5.26-1.739c.854 0 1.653.1 2.4.3.746.2 1.28.394 1.6.58l.48.279-.92 2.521c-.854-.666-1.974-1-3.36-1-1.387 0-2.42.26-3.1.78-.68.52-1.02 1.18-1.02 1.979 0 .88.426 1.574 1.28 2.08.853.507 1.813.934 2.88 1.28 1.066.347 2.126.733 3.18 1.16 1.053.427 1.946 1.094 2.68 2s1.1 2.106 1.1 3.6c0 1.494-.6 2.794-1.8 3.9-1.2 1.106-2.954 1.66-5.26 1.66-2.307 0-4.114-.547-5.42-1.64-1.307-1.093-1.987-2.44-2.04-4.04z"
                                              fill="#c1dbe6" data-original="#89d3ff"/>
                                    </g>
                                </svg>
                                Photoshop
                            </div>
                            <span class="status">
                <span class="status-circle green"></span>
                Updated</span>
                            <div class="button-wrapper">
                                <button class="content-button status-button open">Open</button>
                                <div class="menu">
                                    <button class="dropdown">
                                        <ul>
                                            <li><a href="#">Go to Discover</a></li>
                                            <li><a href="#">Learn more</a></li>
                                            <li><a href="#">Uninstall</a></li>
                                        </ul>
                                    </button>
                                </div>
                            </div>
                        </li>
                        <li class="adobe-product">
                            <div class="products">
                                <svg viewBox="0 0 52 52" style="border:1px solid #b65a0b">
                                    <g xmlns="http://www.w3.org/2000/svg">
                                        <path d="M40.824 52H11.176C5.003 52 0 46.997 0 40.824V11.176C0 5.003 5.003 0 11.176 0h29.649C46.997 0 52 5.003 52 11.176v29.649C52 46.997 46.997 52 40.824 52z"
                                              fill="#261400" data-original="#6d4c13"/>
                                        <path d="M30.68 39h-3.24l-2.76-9.04h-8.32L13.72 39H10.6l8.24-28h3.32l8.52 28zm-6.72-12l-3.48-11.36L17.12 27h6.84zM37.479 12.24c0 .453-.16.84-.48 1.16-.32.319-.7.479-1.14.479-.44 0-.827-.166-1.16-.5-.334-.333-.5-.713-.5-1.14s.166-.807.5-1.141c.333-.333.72-.5 1.16-.5.44 0 .82.16 1.14.48.321.322.48.709.48 1.162zM37.24 39h-2.88V18.96h2.88V39z"
                                              fill="#e6d2c0" data-original="#ffbd2e"/>
                                    </g>
                                </svg>
                                Illustrator
                            </div>
                            <span class="status">
                <span class="status-circle"></span>
                Update Available</span>
                            <div class="button-wrapper">
                                <button class="content-button">Update this app</button>

                                <div class="menu">
                                    <button class="dropdown">
                                        <ul>
                                            <li><a href="#">Go to Discover</a></li>
                                            <li><a href="#">Learn more</a></li>
                                            <li><a href="#">Uninstall</a></li>
                                        </ul>
                                    </button>
                                </div>
                            </div>
                        </li>
                        <li class="adobe-product">
                            <div class="products">
                                <svg viewBox="0 0 52 52" style="border: 1px solid #C75DEB">
                                    <g xmlns="http://www.w3.org/2000/svg">
                                        <path d="M40.824 52H11.176C5.003 52 0 46.997 0 40.824V11.176C0 5.003 5.003 0 11.176 0h29.649C46.997 0 52 5.003 52 11.176v29.649C52 46.997 46.997 52 40.824 52z"
                                              fill="#3a3375" data-original="#3a3375"/>
                                        <path d="M27.44 39H24.2l-2.76-9.04h-8.32L10.48 39H7.36l8.24-28h3.32l8.52 28zm-6.72-12l-3.48-11.36L13.88 27h6.84zM31.48 33.48c0 2.267 1.333 3.399 4 3.399 1.653 0 3.466-.546 5.44-1.64L42 37.6c-2.054 1.254-4.2 1.881-6.44 1.881-4.64 0-6.96-1.946-6.96-5.841v-8.2c0-2.16.673-3.841 2.02-5.04 1.346-1.2 3.126-1.801 5.34-1.801s3.94.594 5.18 1.78c1.24 1.187 1.86 2.834 1.86 4.94V30.8l-11.52.6v2.08zm8.6-5.24v-3.08c0-1.413-.44-2.42-1.32-3.021-.88-.6-1.907-.899-3.08-.899-1.174 0-2.167.359-2.98 1.08-.814.72-1.22 1.773-1.22 3.16v3.199l8.6-.439z"
                                              fill="#e4d1eb" data-original="#e7adfb"/>
                                    </g>
                                </svg>
                                After Effects
                            </div>
                            <span class="status">
                <span class="status-circle green"></span>
                Updated</span>
                            <div class="button-wrapper">
                                <button class="content-button status-button open">Open</button>
                                <div class="menu">
                                    <button class="dropdown">
                                        <ul>
                                            <li><a href="#">Go to Discover</a></li>
                                            <li><a href="#">Learn more</a></li>
                                            <li><a href="#">Uninstall</a></li>
                                        </ul>
                                    </button>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="content-section">
                    <div class="content-section-title">Apps in your plan</div>
                    <div class="apps-card">
                        <div class="app-card">
              <span>
                <svg viewBox="0 0 512 512" style="border: 1px solid #a059a9">
                  <path xmlns="http://www.w3.org/2000/svg"
                        d="M480 0H32C14.368 0 0 14.368 0 32v448c0 17.664 14.368 32 32 32h448c17.664 0 32-14.336 32-32V32c0-17.632-14.336-32-32-32z"
                        fill="#210027" data-original="#7b1fa2"/>
                  <g xmlns="http://www.w3.org/2000/svg">
                    <path d="M192 64h-80c-8.832 0-16 7.168-16 16v352c0 8.832 7.168 16 16 16s16-7.168 16-16V256h64c52.928 0 96-43.072 96-96s-43.072-96-96-96zm0 160h-64V96h64c35.296 0 64 28.704 64 64s-28.704 64-64 64zM400 256h-32c-18.08 0-34.592 6.24-48 16.384V272c0-8.864-7.168-16-16-16s-16 7.136-16 16v160c0 8.832 7.168 16 16 16s16-7.168 16-16v-96c0-26.464 21.536-48 48-48h32c8.832 0 16-7.168 16-16s-7.168-16-16-16z"
                          fill="#f6e7fa" data-original="#e1bee7"/>
                  </g>
                </svg>
                Premiere Pro
              </span>
                            <div class="app-card__subtext">Edit, master and create fully proffesional videos</div>
                            <div class="app-card-buttons">
                                <button class="content-button status-button">Update</button>
                                <div class="menu"></div>
                            </div>
                        </div>
                        <div class="app-card">
              <span>
                <svg viewBox="0 0 52 52" style="border: 1px solid #c1316d">
                  <g xmlns="http://www.w3.org/2000/svg">
                    <path d="M40.824 52H11.176C5.003 52 0 46.997 0 40.824V11.176C0 5.003 5.003 0 11.176 0h29.649C46.997 0 52 5.003 52 11.176v29.649C52 46.997 46.997 52 40.824 52z"
                          fill="#2f0015" data-original="#6f2b41"/>
                    <path d="M18.08 39H15.2V13.72l-2.64-.08V11h5.52v28zM27.68 19.4c1.173-.507 2.593-.761 4.26-.761s3.073.374 4.22 1.12V11h2.88v28c-2.293.32-4.414.48-6.36.48-1.947 0-3.707-.4-5.28-1.2-2.08-1.066-3.12-2.92-3.12-5.561v-7.56c0-2.799 1.133-4.719 3.4-5.759zm8.48 3.12c-1.387-.746-2.907-1.119-4.56-1.119-1.574 0-2.714.406-3.42 1.22-.707.813-1.06 1.847-1.06 3.1v7.12c0 1.227.44 2.188 1.32 2.88.96.719 2.146 1.079 3.56 1.079 1.413 0 2.8-.106 4.16-.319V22.52z"
                          fill="#e1c1cf" data-original="#ff70bd"/>
                  </g>
                </svg>
                InDesign
              </span>
                            <div class="app-card__subtext">Design and publish great projects & mockups</div>
                            <div class="app-card-buttons">
                                <button class="content-button status-button">Update</button>
                                <div class="menu"></div>
                            </div>
                        </div>
                        <div class="app-card">
              <span>
                <svg viewBox="0 0 52 52" style="border: 1px solid #C75DEB">
                  <g xmlns="http://www.w3.org/2000/svg">
                    <path d="M40.824 52H11.176C5.003 52 0 46.997 0 40.824V11.176C0 5.003 5.003 0 11.176 0h29.649C46.997 0 52 5.003 52 11.176v29.649C52 46.997 46.997 52 40.824 52z"
                          fill="#3a3375" data-original="#3a3375"/>
                    <path d="M27.44 39H24.2l-2.76-9.04h-8.32L10.48 39H7.36l8.24-28h3.32l8.52 28zm-6.72-12l-3.48-11.36L13.88 27h6.84zM31.48 33.48c0 2.267 1.333 3.399 4 3.399 1.653 0 3.466-.546 5.44-1.64L42 37.6c-2.054 1.254-4.2 1.881-6.44 1.881-4.64 0-6.96-1.946-6.96-5.841v-8.2c0-2.16.673-3.841 2.02-5.04 1.346-1.2 3.126-1.801 5.34-1.801s3.94.594 5.18 1.78c1.24 1.187 1.86 2.834 1.86 4.94V30.8l-11.52.6v2.08zm8.6-5.24v-3.08c0-1.413-.44-2.42-1.32-3.021-.88-.6-1.907-.899-3.08-.899-1.174 0-2.167.359-2.98 1.08-.814.72-1.22 1.773-1.22 3.16v3.199l8.6-.439z"
                          fill="#e4d1eb" data-original="#e7adfb"/>
                  </g>
                </svg>
                After Effects
              </span>
                            <div class="app-card__subtext">Industry Standart motion graphics & visual effects</div>
                            <div class="app-card-buttons">
                                <button class="content-button status-button">Update</button>
                                <div class="menu"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-wrapper " id="m-side_1_">
                <div class="content-wrapper-header">
                    <div class="content-wrapper-context">
                        <h3 class="img-content">
                            <svg viewBox="0 0 512 512">
                                <path d="M467 0H45C20.099 0 0 20.099 0 45v422c0 24.901 20.099 45 45 45h422c24.901 0 45-20.099 45-45V45c0-24.901-20.099-45-45-45z"
                                      fill="#d6355b" data-original="#ff468c"/>
                                <path xmlns="http://www.w3.org/2000/svg"
                                      d="M512 45v422c0 24.901-20.099 45-45 45H256V0h211c24.901 0 45 20.099 45 45z"
                                      fill="#d6355b" data-original="#d72878"/>
                                <path xmlns="http://www.w3.org/2000/svg"
                                      d="M467 30H45c-8.401 0-15 6.599-15 15v422c0 8.401 6.599 15 15 15h422c8.401 0 15-6.599 15-15V45c0-8.401-6.599-15-15-15z"
                                      fill="#2e000a" data-original="#700029"/>
                                <path xmlns="http://www.w3.org/2000/svg"
                                      d="M482 45v422c0 8.401-6.599 15-15 15H256V30h211c8.401 0 15 6.599 15 15z"
                                      fill="#2e000a" data-original="#4d0e06"/>
                                <path xmlns="http://www.w3.org/2000/svg"
                                      d="M181 391c-41.353 0-75-33.647-75-75 0-8.291 6.709-15 15-15s15 6.709 15 15c0 24.814 20.186 45 45 45s45-20.186 45-45-20.186-45-45-45c-41.353 0-75-33.647-75-75s33.647-75 75-75 75 33.647 75 75c0 8.291-6.709 15-15 15s-15-6.709-15-15c0-24.814-20.186-45-45-45s-45 20.186-45 45 20.186 45 45 45c41.353 0 75 33.647 75 75s-33.647 75-75 75z"
                                      fill="#d6355b" data-original="#ff468c"/>
                                <path xmlns="http://www.w3.org/2000/svg"
                                      d="M391 361h-30c-8.276 0-15-6.724-15-15V211h45c8.291 0 15-6.709 15-15s-6.709-15-15-15h-45v-45c0-8.291-6.709-15-15-15s-15 6.709-15 15v45h-15c-8.291 0-15 6.709-15 15s6.709 15 15 15h15v135c0 24.814 20.186 45 45 45h30c8.291 0 15-6.709 15-15s-6.709-15-15-15z"
                                      fill="#d6355b" data-original="#d72878"/>
                            </svg>
                            Adobe Stock
                        </h3>
                        <div class="content-text">Grab yourself 10 free images from Adobe Stock in a 30-day free trial
                            plan and find perfect image, that will help you with your new project.
                        </div>
                        <button class="content-button">Start free trial</button>
                    </div>
                    <img class="content-wrapper-img" src="https://assets.codepen.io/3364143/glass.png" alt="">
                </div>
                <div class="content-section">


                    <div class="content-section-title">Installed</div>
                    <ul>
                        <li class="adobe-product">
                            <div class="products">
                                <svg viewBox="0 0 52 52" style="border:1px solid #3291b8">
                                    <g xmlns="http://www.w3.org/2000/svg">
                                        <path d="M40.824 52H11.176C5.003 52 0 46.997 0 40.824V11.176C0 5.003 5.003 0 11.176 0h29.649C46.997 0 52 5.003 52 11.176v29.649C52 46.997 46.997 52 40.824 52z"
                                              fill="#061e26" data-original="#393687"/>
                                        <path d="M12.16 39H9.28V11h9.64c2.613 0 4.553.813 5.82 2.44 1.266 1.626 1.9 3.76 1.9 6.399 0 .934-.027 1.74-.08 2.42-.054.681-.22 1.534-.5 2.561-.28 1.026-.66 1.866-1.14 2.52-.48.654-1.213 1.227-2.2 1.72-.987.494-2.16.74-3.52.74h-7.04V39zm0-12h6.68c.96 0 1.773-.187 2.44-.56.666-.374 1.153-.773 1.46-1.2.306-.427.546-1.04.72-1.84.173-.801.267-1.4.28-1.801.013-.399.02-.973.02-1.72 0-4.053-1.694-6.08-5.08-6.08h-6.52V27zM29.48 33.92l2.8-.12c.106.987.6 1.754 1.48 2.3.88.547 1.893.82 3.04.82s2.14-.26 2.98-.78c.84-.52 1.26-1.266 1.26-2.239s-.36-1.747-1.08-2.32c-.72-.573-1.6-1.026-2.64-1.36-1.04-.333-2.086-.686-3.14-1.06a7.36 7.36 0 01-2.78-1.76c-.987-.934-1.48-2.073-1.48-3.42s.54-2.601 1.62-3.761 2.833-1.739 5.26-1.739c.854 0 1.653.1 2.4.3.746.2 1.28.394 1.6.58l.48.279-.92 2.521c-.854-.666-1.974-1-3.36-1-1.387 0-2.42.26-3.1.78-.68.52-1.02 1.18-1.02 1.979 0 .88.426 1.574 1.28 2.08.853.507 1.813.934 2.88 1.28 1.066.347 2.126.733 3.18 1.16 1.053.427 1.946 1.094 2.68 2s1.1 2.106 1.1 3.6c0 1.494-.6 2.794-1.8 3.9-1.2 1.106-2.954 1.66-5.26 1.66-2.307 0-4.114-.547-5.42-1.64-1.307-1.093-1.987-2.44-2.04-4.04z"
                                              fill="#c1dbe6" data-original="#89d3ff"/>
                                    </g>
                                </svg>
                                Photoshop
                            </div>
                            <span class="status">
                <span class="status-circle green"></span>
                Updated</span>
                            <div class="button-wrapper">
                                <button class="content-button status-button open">Open</button>
                                <div class="menu">
                                    <button class="dropdown">
                                        <ul>
                                            <li><a href="#">Go to Discover</a></li>
                                            <li><a href="#">Learn more</a></li>
                                            <li><a href="#">Uninstall</a></li>
                                        </ul>
                                    </button>
                                </div>
                            </div>
                        </li>
                        <li class="adobe-product">
                            <div class="products">
                                <svg viewBox="0 0 52 52" style="border:1px solid #b65a0b">
                                    <g xmlns="http://www.w3.org/2000/svg">
                                        <path d="M40.824 52H11.176C5.003 52 0 46.997 0 40.824V11.176C0 5.003 5.003 0 11.176 0h29.649C46.997 0 52 5.003 52 11.176v29.649C52 46.997 46.997 52 40.824 52z"
                                              fill="#261400" data-original="#6d4c13"/>
                                        <path d="M30.68 39h-3.24l-2.76-9.04h-8.32L13.72 39H10.6l8.24-28h3.32l8.52 28zm-6.72-12l-3.48-11.36L17.12 27h6.84zM37.479 12.24c0 .453-.16.84-.48 1.16-.32.319-.7.479-1.14.479-.44 0-.827-.166-1.16-.5-.334-.333-.5-.713-.5-1.14s.166-.807.5-1.141c.333-.333.72-.5 1.16-.5.44 0 .82.16 1.14.48.321.322.48.709.48 1.162zM37.24 39h-2.88V18.96h2.88V39z"
                                              fill="#e6d2c0" data-original="#ffbd2e"/>
                                    </g>
                                </svg>
                                Illustrator
                            </div>
                            <span class="status">
                <span class="status-circle"></span>
                Update Available</span>
                            <div class="button-wrapper">
                                <button class="content-button">Update this app</button>
                                <div class="pop-up">
                                    <div class="pop-up__title">Update This App
                                        <svg class="close" width="24" height="24" fill="none" stroke="currentColor"
                                             stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                             class="feather feather-x-circle">
                                            <circle cx="12" cy="12" r="10"/>
                                            <path d="M15 9l-6 6M9 9l6 6"/>
                                        </svg>
                                    </div>
                                    <div class="pop-up__subtitle">Adjust your selections for advanced options as desired
                                        before continuing. <a href="#">Learn more</a></div>
                                    <div class="checkbox-wrapper">
                                        <input type="checkbox" id="check1" class="checkbox">
                                        <label for="check1">Import previous settings and preferences</label>
                                    </div>
                                    <div class="checkbox-wrapper">
                                        <input type="checkbox" id="check2" class="checkbox">
                                        <label for="check2">Remove old versions</label>
                                    </div>
                                    <div class="content-button-wrapper">
                                        <button class="content-button status-button open close">Cancel</button>
                                        <button class="content-button status-button">Continue</button>
                                    </div>
                                </div>
                                <div class="menu">
                                    <button class="dropdown">
                                        <ul>
                                            <li><a href="#">Go to Discover</a></li>
                                            <li><a href="#">Learn more</a></li>
                                            <li><a href="#">Uninstall</a></li>
                                        </ul>
                                    </button>
                                </div>
                            </div>
                        </li>
                        <li class="adobe-product">
                            <div class="products">
                                <svg viewBox="0 0 52 52" style="border: 1px solid #C75DEB">
                                    <g xmlns="http://www.w3.org/2000/svg">
                                        <path d="M40.824 52H11.176C5.003 52 0 46.997 0 40.824V11.176C0 5.003 5.003 0 11.176 0h29.649C46.997 0 52 5.003 52 11.176v29.649C52 46.997 46.997 52 40.824 52z"
                                              fill="#3a3375" data-original="#3a3375"/>
                                        <path d="M27.44 39H24.2l-2.76-9.04h-8.32L10.48 39H7.36l8.24-28h3.32l8.52 28zm-6.72-12l-3.48-11.36L13.88 27h6.84zM31.48 33.48c0 2.267 1.333 3.399 4 3.399 1.653 0 3.466-.546 5.44-1.64L42 37.6c-2.054 1.254-4.2 1.881-6.44 1.881-4.64 0-6.96-1.946-6.96-5.841v-8.2c0-2.16.673-3.841 2.02-5.04 1.346-1.2 3.126-1.801 5.34-1.801s3.94.594 5.18 1.78c1.24 1.187 1.86 2.834 1.86 4.94V30.8l-11.52.6v2.08zm8.6-5.24v-3.08c0-1.413-.44-2.42-1.32-3.021-.88-.6-1.907-.899-3.08-.899-1.174 0-2.167.359-2.98 1.08-.814.72-1.22 1.773-1.22 3.16v3.199l8.6-.439z"
                                              fill="#e4d1eb" data-original="#e7adfb"/>
                                    </g>
                                </svg>
                                After Effects
                            </div>
                            <span class="status">
                <span class="status-circle green"></span>
                Updated</span>
                            <div class="button-wrapper">
                                <button class="content-button status-button open">Open</button>
                                <div class="menu">
                                    <button class="dropdown">
                                        <ul>
                                            <li><a href="#">Go to Discover</a></li>
                                            <li><a href="#">Learn more</a></li>
                                            <li><a href="#">Uninstall</a></li>
                                        </ul>
                                    </button>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="content-section">
                    <div class="content-section-title">Apps in your plan</div>
                    <div class="apps-card">
                        <div class="app-card">
              <span>
                <svg viewBox="0 0 512 512" style="border: 1px solid #a059a9">
                  <path xmlns="http://www.w3.org/2000/svg"
                        d="M480 0H32C14.368 0 0 14.368 0 32v448c0 17.664 14.368 32 32 32h448c17.664 0 32-14.336 32-32V32c0-17.632-14.336-32-32-32z"
                        fill="#210027" data-original="#7b1fa2"/>
                  <g xmlns="http://www.w3.org/2000/svg">
                    <path d="M192 64h-80c-8.832 0-16 7.168-16 16v352c0 8.832 7.168 16 16 16s16-7.168 16-16V256h64c52.928 0 96-43.072 96-96s-43.072-96-96-96zm0 160h-64V96h64c35.296 0 64 28.704 64 64s-28.704 64-64 64zM400 256h-32c-18.08 0-34.592 6.24-48 16.384V272c0-8.864-7.168-16-16-16s-16 7.136-16 16v160c0 8.832 7.168 16 16 16s16-7.168 16-16v-96c0-26.464 21.536-48 48-48h32c8.832 0 16-7.168 16-16s-7.168-16-16-16z"
                          fill="#f6e7fa" data-original="#e1bee7"/>
                  </g>
                </svg>
                Premiere Pro
              </span>
                            <div class="app-card__subtext">Edit, master and create fully proffesional videos</div>
                            <div class="app-card-buttons">
                                <button class="content-button status-button">Update</button>
                                <div class="menu"></div>
                            </div>
                        </div>
                        <div class="app-card">
              <span>
                <svg viewBox="0 0 52 52" style="border: 1px solid #c1316d">
                  <g xmlns="http://www.w3.org/2000/svg">
                    <path d="M40.824 52H11.176C5.003 52 0 46.997 0 40.824V11.176C0 5.003 5.003 0 11.176 0h29.649C46.997 0 52 5.003 52 11.176v29.649C52 46.997 46.997 52 40.824 52z"
                          fill="#2f0015" data-original="#6f2b41"/>
                    <path d="M18.08 39H15.2V13.72l-2.64-.08V11h5.52v28zM27.68 19.4c1.173-.507 2.593-.761 4.26-.761s3.073.374 4.22 1.12V11h2.88v28c-2.293.32-4.414.48-6.36.48-1.947 0-3.707-.4-5.28-1.2-2.08-1.066-3.12-2.92-3.12-5.561v-7.56c0-2.799 1.133-4.719 3.4-5.759zm8.48 3.12c-1.387-.746-2.907-1.119-4.56-1.119-1.574 0-2.714.406-3.42 1.22-.707.813-1.06 1.847-1.06 3.1v7.12c0 1.227.44 2.188 1.32 2.88.96.719 2.146 1.079 3.56 1.079 1.413 0 2.8-.106 4.16-.319V22.52z"
                          fill="#e1c1cf" data-original="#ff70bd"/>
                  </g>
                </svg>
                InDesign
              </span>
                            <div class="app-card__subtext">Design and publish great projects & mockups</div>
                            <div class="app-card-buttons">
                                <button class="content-button status-button">Update</button>
                                <div class="menu"></div>
                            </div>
                        </div>
                        <div class="app-card">
              <span>
                <svg viewBox="0 0 52 52" style="border: 1px solid #C75DEB">
                  <g xmlns="http://www.w3.org/2000/svg">
                    <path d="M40.824 52H11.176C5.003 52 0 46.997 0 40.824V11.176C0 5.003 5.003 0 11.176 0h29.649C46.997 0 52 5.003 52 11.176v29.649C52 46.997 46.997 52 40.824 52z"
                          fill="#3a3375" data-original="#3a3375"/>
                    <path d="M27.44 39H24.2l-2.76-9.04h-8.32L10.48 39H7.36l8.24-28h3.32l8.52 28zm-6.72-12l-3.48-11.36L13.88 27h6.84zM31.48 33.48c0 2.267 1.333 3.399 4 3.399 1.653 0 3.466-.546 5.44-1.64L42 37.6c-2.054 1.254-4.2 1.881-6.44 1.881-4.64 0-6.96-1.946-6.96-5.841v-8.2c0-2.16.673-3.841 2.02-5.04 1.346-1.2 3.126-1.801 5.34-1.801s3.94.594 5.18 1.78c1.24 1.187 1.86 2.834 1.86 4.94V30.8l-11.52.6v2.08zm8.6-5.24v-3.08c0-1.413-.44-2.42-1.32-3.021-.88-.6-1.907-.899-3.08-.899-1.174 0-2.167.359-2.98 1.08-.814.72-1.22 1.773-1.22 3.16v3.199l8.6-.439z"
                          fill="#e4d1eb" data-original="#e7adfb"/>
                  </g>
                </svg>
                After Effects
              </span>
                            <div class="app-card__subtext">Industry Standart motion graphics & visual effects</div>
                            <div class="app-card-buttons">
                                <button class="content-button status-button">Update</button>
                                <div class="menu"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-wrapper " id="_2">
                <div class="content-wrapper-header">
                    <div class="content-wrapper-context">
                        <h3 class="img-content">
                            <svg viewBox="0 0 512 512">
                                <path d="M467 0H45C20.099 0 0 20.099 0 45v422c0 24.901 20.099 45 45 45h422c24.901 0 45-20.099 45-45V45c0-24.901-20.099-45-45-45z"
                                      fill="#d6355b" data-original="#ff468c"/>
                                <path xmlns="http://www.w3.org/2000/svg"
                                      d="M512 45v422c0 24.901-20.099 45-45 45H256V0h211c24.901 0 45 20.099 45 45z"
                                      fill="#d6355b" data-original="#d72878"/>
                                <path xmlns="http://www.w3.org/2000/svg"
                                      d="M467 30H45c-8.401 0-15 6.599-15 15v422c0 8.401 6.599 15 15 15h422c8.401 0 15-6.599 15-15V45c0-8.401-6.599-15-15-15z"
                                      fill="#2e000a" data-original="#700029"/>
                                <path xmlns="http://www.w3.org/2000/svg"
                                      d="M482 45v422c0 8.401-6.599 15-15 15H256V30h211c8.401 0 15 6.599 15 15z"
                                      fill="#2e000a" data-original="#4d0e06"/>
                                <path xmlns="http://www.w3.org/2000/svg"
                                      d="M181 391c-41.353 0-75-33.647-75-75 0-8.291 6.709-15 15-15s15 6.709 15 15c0 24.814 20.186 45 45 45s45-20.186 45-45-20.186-45-45-45c-41.353 0-75-33.647-75-75s33.647-75 75-75 75 33.647 75 75c0 8.291-6.709 15-15 15s-15-6.709-15-15c0-24.814-20.186-45-45-45s-45 20.186-45 45 20.186 45 45 45c41.353 0 75 33.647 75 75s-33.647 75-75 75z"
                                      fill="#d6355b" data-original="#ff468c"/>
                                <path xmlns="http://www.w3.org/2000/svg"
                                      d="M391 361h-30c-8.276 0-15-6.724-15-15V211h45c8.291 0 15-6.709 15-15s-6.709-15-15-15h-45v-45c0-8.291-6.709-15-15-15s-15 6.709-15 15v45h-15c-8.291 0-15 6.709-15 15s6.709 15 15 15h15v135c0 24.814 20.186 45 45 45h30c8.291 0 15-6.709 15-15s-6.709-15-15-15z"
                                      fill="#d6355b" data-original="#d72878"/>
                            </svg>
                            Adobe Stock
                        </h3>
                        <div class="content-text">Grab yourself 10 free images from Adobe Stock in a 30-day free trial
                            plan and find perfect image, that will help you with your new project.
                        </div>
                        <button class="content-button">Start free trial</button>
                    </div>
                    <img class="content-wrapper-img" src="https://assets.codepen.io/3364143/glass.png" alt="">
                </div>
                <div class="content-section">
                    <div class="content-section-title">Installed</div>
                    <ul>
                        <li class="adobe-product">
                            <div class="products">
                                <svg viewBox="0 0 52 52" style="border:1px solid #3291b8">
                                    <g xmlns="http://www.w3.org/2000/svg">
                                        <path d="M40.824 52H11.176C5.003 52 0 46.997 0 40.824V11.176C0 5.003 5.003 0 11.176 0h29.649C46.997 0 52 5.003 52 11.176v29.649C52 46.997 46.997 52 40.824 52z"
                                              fill="#061e26" data-original="#393687"/>
                                        <path d="M12.16 39H9.28V11h9.64c2.613 0 4.553.813 5.82 2.44 1.266 1.626 1.9 3.76 1.9 6.399 0 .934-.027 1.74-.08 2.42-.054.681-.22 1.534-.5 2.561-.28 1.026-.66 1.866-1.14 2.52-.48.654-1.213 1.227-2.2 1.72-.987.494-2.16.74-3.52.74h-7.04V39zm0-12h6.68c.96 0 1.773-.187 2.44-.56.666-.374 1.153-.773 1.46-1.2.306-.427.546-1.04.72-1.84.173-.801.267-1.4.28-1.801.013-.399.02-.973.02-1.72 0-4.053-1.694-6.08-5.08-6.08h-6.52V27zM29.48 33.92l2.8-.12c.106.987.6 1.754 1.48 2.3.88.547 1.893.82 3.04.82s2.14-.26 2.98-.78c.84-.52 1.26-1.266 1.26-2.239s-.36-1.747-1.08-2.32c-.72-.573-1.6-1.026-2.64-1.36-1.04-.333-2.086-.686-3.14-1.06a7.36 7.36 0 01-2.78-1.76c-.987-.934-1.48-2.073-1.48-3.42s.54-2.601 1.62-3.761 2.833-1.739 5.26-1.739c.854 0 1.653.1 2.4.3.746.2 1.28.394 1.6.58l.48.279-.92 2.521c-.854-.666-1.974-1-3.36-1-1.387 0-2.42.26-3.1.78-.68.52-1.02 1.18-1.02 1.979 0 .88.426 1.574 1.28 2.08.853.507 1.813.934 2.88 1.28 1.066.347 2.126.733 3.18 1.16 1.053.427 1.946 1.094 2.68 2s1.1 2.106 1.1 3.6c0 1.494-.6 2.794-1.8 3.9-1.2 1.106-2.954 1.66-5.26 1.66-2.307 0-4.114-.547-5.42-1.64-1.307-1.093-1.987-2.44-2.04-4.04z"
                                              fill="#c1dbe6" data-original="#89d3ff"/>
                                    </g>
                                </svg>
                                Photoshop
                            </div>
                            <span class="status">
                <span class="status-circle green"></span>
                Updated</span>
                            <div class="button-wrapper">
                                <button class="content-button status-button open">Open</button>
                                <div class="menu">
                                    <button class="dropdown">
                                        <ul>
                                            <li><a href="#">Go to Discover</a></li>
                                            <li><a href="#">Learn more</a></li>
                                            <li><a href="#">Uninstall</a></li>
                                        </ul>
                                    </button>
                                </div>
                            </div>
                        </li>
                        <li class="adobe-product">
                            <div class="products">
                                <svg viewBox="0 0 52 52" style="border:1px solid #b65a0b">
                                    <g xmlns="http://www.w3.org/2000/svg">
                                        <path d="M40.824 52H11.176C5.003 52 0 46.997 0 40.824V11.176C0 5.003 5.003 0 11.176 0h29.649C46.997 0 52 5.003 52 11.176v29.649C52 46.997 46.997 52 40.824 52z"
                                              fill="#261400" data-original="#6d4c13"/>
                                        <path d="M30.68 39h-3.24l-2.76-9.04h-8.32L13.72 39H10.6l8.24-28h3.32l8.52 28zm-6.72-12l-3.48-11.36L17.12 27h6.84zM37.479 12.24c0 .453-.16.84-.48 1.16-.32.319-.7.479-1.14.479-.44 0-.827-.166-1.16-.5-.334-.333-.5-.713-.5-1.14s.166-.807.5-1.141c.333-.333.72-.5 1.16-.5.44 0 .82.16 1.14.48.321.322.48.709.48 1.162zM37.24 39h-2.88V18.96h2.88V39z"
                                              fill="#e6d2c0" data-original="#ffbd2e"/>
                                    </g>
                                </svg>
                                Illustrator
                            </div>
                            <span class="status">
                <span class="status-circle"></span>
                Update Available</span>
                            <div class="button-wrapper">
                                <button class="content-button">Update this app</button>
                                <div class="pop-up">
                                    <div class="pop-up__title">Update This App
                                        <svg class="close" width="24" height="24" fill="none" stroke="currentColor"
                                             stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                             class="feather feather-x-circle">
                                            <circle cx="12" cy="12" r="10"/>
                                            <path d="M15 9l-6 6M9 9l6 6"/>
                                        </svg>
                                    </div>
                                    <div class="pop-up__subtitle">Adjust your selections for advanced options as desired
                                        before continuing. <a href="#">Learn more</a></div>
                                    <div class="checkbox-wrapper">
                                        <input type="checkbox" id="check1" class="checkbox">
                                        <label for="check1">Import previous settings and preferences</label>
                                    </div>
                                    <div class="checkbox-wrapper">
                                        <input type="checkbox" id="check2" class="checkbox">
                                        <label for="check2">Remove old versions</label>
                                    </div>
                                    <div class="content-button-wrapper">
                                        <button class="content-button status-button open close">Cancel</button>
                                        <button class="content-button status-button">Continue</button>
                                    </div>
                                </div>
                                <div class="menu">
                                    <button class="dropdown">
                                        <ul>
                                            <li><a href="#">Go to Discover</a></li>
                                            <li><a href="#">Learn more</a></li>
                                            <li><a href="#">Uninstall</a></li>
                                        </ul>
                                    </button>
                                </div>
                            </div>
                        </li>
                        <li class="adobe-product">
                            <div class="products">
                                <svg viewBox="0 0 52 52" style="border: 1px solid #C75DEB">
                                    <g xmlns="http://www.w3.org/2000/svg">
                                        <path d="M40.824 52H11.176C5.003 52 0 46.997 0 40.824V11.176C0 5.003 5.003 0 11.176 0h29.649C46.997 0 52 5.003 52 11.176v29.649C52 46.997 46.997 52 40.824 52z"
                                              fill="#3a3375" data-original="#3a3375"/>
                                        <path d="M27.44 39H24.2l-2.76-9.04h-8.32L10.48 39H7.36l8.24-28h3.32l8.52 28zm-6.72-12l-3.48-11.36L13.88 27h6.84zM31.48 33.48c0 2.267 1.333 3.399 4 3.399 1.653 0 3.466-.546 5.44-1.64L42 37.6c-2.054 1.254-4.2 1.881-6.44 1.881-4.64 0-6.96-1.946-6.96-5.841v-8.2c0-2.16.673-3.841 2.02-5.04 1.346-1.2 3.126-1.801 5.34-1.801s3.94.594 5.18 1.78c1.24 1.187 1.86 2.834 1.86 4.94V30.8l-11.52.6v2.08zm8.6-5.24v-3.08c0-1.413-.44-2.42-1.32-3.021-.88-.6-1.907-.899-3.08-.899-1.174 0-2.167.359-2.98 1.08-.814.72-1.22 1.773-1.22 3.16v3.199l8.6-.439z"
                                              fill="#e4d1eb" data-original="#e7adfb"/>
                                    </g>
                                </svg>
                                After Effects
                            </div>
                            <span class="status">
                <span class="status-circle green"></span>
                Updated</span>
                            <div class="button-wrapper">
                                <button class="content-button status-button open">Open</button>
                                <div class="menu">
                                    <button class="dropdown">
                                        <ul>
                                            <li><a href="#">Go to Discover</a></li>
                                            <li><a href="#">Learn more</a></li>
                                            <li><a href="#">Uninstall</a></li>
                                        </ul>
                                    </button>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="content-section">
                    <div class="content-section-title">Apps in your plan</div>
                    <div class="apps-card">
                        <div class="app-card">
              <span>
                <svg viewBox="0 0 512 512" style="border: 1px solid #a059a9">
                  <path xmlns="http://www.w3.org/2000/svg"
                        d="M480 0H32C14.368 0 0 14.368 0 32v448c0 17.664 14.368 32 32 32h448c17.664 0 32-14.336 32-32V32c0-17.632-14.336-32-32-32z"
                        fill="#210027" data-original="#7b1fa2"/>
                  <g xmlns="http://www.w3.org/2000/svg">
                    <path d="M192 64h-80c-8.832 0-16 7.168-16 16v352c0 8.832 7.168 16 16 16s16-7.168 16-16V256h64c52.928 0 96-43.072 96-96s-43.072-96-96-96zm0 160h-64V96h64c35.296 0 64 28.704 64 64s-28.704 64-64 64zM400 256h-32c-18.08 0-34.592 6.24-48 16.384V272c0-8.864-7.168-16-16-16s-16 7.136-16 16v160c0 8.832 7.168 16 16 16s16-7.168 16-16v-96c0-26.464 21.536-48 48-48h32c8.832 0 16-7.168 16-16s-7.168-16-16-16z"
                          fill="#f6e7fa" data-original="#e1bee7"/>
                  </g>
                </svg>
                Premiere Pro
              </span>
                            <div class="app-card__subtext">Edit, master and create fully proffesional videos</div>
                            <div class="app-card-buttons">
                                <button class="content-button status-button">Update</button>
                                <div class="menu"></div>
                            </div>
                        </div>
                        <div class="app-card">
              <span>
                <svg viewBox="0 0 52 52" style="border: 1px solid #c1316d">
                  <g xmlns="http://www.w3.org/2000/svg">
                    <path d="M40.824 52H11.176C5.003 52 0 46.997 0 40.824V11.176C0 5.003 5.003 0 11.176 0h29.649C46.997 0 52 5.003 52 11.176v29.649C52 46.997 46.997 52 40.824 52z"
                          fill="#2f0015" data-original="#6f2b41"/>
                    <path d="M18.08 39H15.2V13.72l-2.64-.08V11h5.52v28zM27.68 19.4c1.173-.507 2.593-.761 4.26-.761s3.073.374 4.22 1.12V11h2.88v28c-2.293.32-4.414.48-6.36.48-1.947 0-3.707-.4-5.28-1.2-2.08-1.066-3.12-2.92-3.12-5.561v-7.56c0-2.799 1.133-4.719 3.4-5.759zm8.48 3.12c-1.387-.746-2.907-1.119-4.56-1.119-1.574 0-2.714.406-3.42 1.22-.707.813-1.06 1.847-1.06 3.1v7.12c0 1.227.44 2.188 1.32 2.88.96.719 2.146 1.079 3.56 1.079 1.413 0 2.8-.106 4.16-.319V22.52z"
                          fill="#e1c1cf" data-original="#ff70bd"/>
                  </g>
                </svg>
                InDesign
              </span>
                            <div class="app-card__subtext">Design and publish great projects & mockups</div>
                            <div class="app-card-buttons">
                                <button class="content-button status-button">Update</button>
                                <div class="menu"></div>
                            </div>
                        </div>
                        <div class="app-card">
              <span>
                <svg viewBox="0 0 52 52" style="border: 1px solid #C75DEB">
                  <g xmlns="http://www.w3.org/2000/svg">
                    <path d="M40.824 52H11.176C5.003 52 0 46.997 0 40.824V11.176C0 5.003 5.003 0 11.176 0h29.649C46.997 0 52 5.003 52 11.176v29.649C52 46.997 46.997 52 40.824 52z"
                          fill="#3a3375" data-original="#3a3375"/>
                    <path d="M27.44 39H24.2l-2.76-9.04h-8.32L10.48 39H7.36l8.24-28h3.32l8.52 28zm-6.72-12l-3.48-11.36L13.88 27h6.84zM31.48 33.48c0 2.267 1.333 3.399 4 3.399 1.653 0 3.466-.546 5.44-1.64L42 37.6c-2.054 1.254-4.2 1.881-6.44 1.881-4.64 0-6.96-1.946-6.96-5.841v-8.2c0-2.16.673-3.841 2.02-5.04 1.346-1.2 3.126-1.801 5.34-1.801s3.94.594 5.18 1.78c1.24 1.187 1.86 2.834 1.86 4.94V30.8l-11.52.6v2.08zm8.6-5.24v-3.08c0-1.413-.44-2.42-1.32-3.021-.88-.6-1.907-.899-3.08-.899-1.174 0-2.167.359-2.98 1.08-.814.72-1.22 1.773-1.22 3.16v3.199l8.6-.439z"
                          fill="#e4d1eb" data-original="#e7adfb"/>
                  </g>
                </svg>
                After Effects
              </span>
                            <div class="app-card__subtext">Industry Standart motion graphics & visual effects</div>
                            <div class="app-card-buttons">
                                <button class="content-button status-button">Update</button>
                                <div class="menu"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-wrapper " id="_3">
                <div class="content-wrapper-header">
                    <div class="content-wrapper-context">
                        <h3 class="img-content">
                            <svg viewBox="0 0 512 512">
                                <path d="M467 0H45C20.099 0 0 20.099 0 45v422c0 24.901 20.099 45 45 45h422c24.901 0 45-20.099 45-45V45c0-24.901-20.099-45-45-45z"
                                      fill="#d6355b" data-original="#ff468c"/>
                                <path xmlns="http://www.w3.org/2000/svg"
                                      d="M512 45v422c0 24.901-20.099 45-45 45H256V0h211c24.901 0 45 20.099 45 45z"
                                      fill="#d6355b" data-original="#d72878"/>
                                <path xmlns="http://www.w3.org/2000/svg"
                                      d="M467 30H45c-8.401 0-15 6.599-15 15v422c0 8.401 6.599 15 15 15h422c8.401 0 15-6.599 15-15V45c0-8.401-6.599-15-15-15z"
                                      fill="#2e000a" data-original="#700029"/>
                                <path xmlns="http://www.w3.org/2000/svg"
                                      d="M482 45v422c0 8.401-6.599 15-15 15H256V30h211c8.401 0 15 6.599 15 15z"
                                      fill="#2e000a" data-original="#4d0e06"/>
                                <path xmlns="http://www.w3.org/2000/svg"
                                      d="M181 391c-41.353 0-75-33.647-75-75 0-8.291 6.709-15 15-15s15 6.709 15 15c0 24.814 20.186 45 45 45s45-20.186 45-45-20.186-45-45-45c-41.353 0-75-33.647-75-75s33.647-75 75-75 75 33.647 75 75c0 8.291-6.709 15-15 15s-15-6.709-15-15c0-24.814-20.186-45-45-45s-45 20.186-45 45 20.186 45 45 45c41.353 0 75 33.647 75 75s-33.647 75-75 75z"
                                      fill="#d6355b" data-original="#ff468c"/>
                                <path xmlns="http://www.w3.org/2000/svg"
                                      d="M391 361h-30c-8.276 0-15-6.724-15-15V211h45c8.291 0 15-6.709 15-15s-6.709-15-15-15h-45v-45c0-8.291-6.709-15-15-15s-15 6.709-15 15v45h-15c-8.291 0-15 6.709-15 15s6.709 15 15 15h15v135c0 24.814 20.186 45 45 45h30c8.291 0 15-6.709 15-15s-6.709-15-15-15z"
                                      fill="#d6355b" data-original="#d72878"/>
                            </svg>
                            Adobe Stock
                        </h3>
                        <div class="content-text">Grab yourself 10 free images from Adobe Stock in a 30-day free trial
                            plan and find perfect image, that will help you with your new project.
                        </div>
                        <button class="content-button">Start free trial</button>
                    </div>
                    <img class="content-wrapper-img" src="https://assets.codepen.io/3364143/glass.png" alt="">
                </div>
                <div class="content-section">
                    <div class="content-section-title">Installed</div>
                    <ul>
                        <li class="adobe-product">
                            <div class="products">
                                <svg viewBox="0 0 52 52" style="border:1px solid #3291b8">
                                    <g xmlns="http://www.w3.org/2000/svg">
                                        <path d="M40.824 52H11.176C5.003 52 0 46.997 0 40.824V11.176C0 5.003 5.003 0 11.176 0h29.649C46.997 0 52 5.003 52 11.176v29.649C52 46.997 46.997 52 40.824 52z"
                                              fill="#061e26" data-original="#393687"/>
                                        <path d="M12.16 39H9.28V11h9.64c2.613 0 4.553.813 5.82 2.44 1.266 1.626 1.9 3.76 1.9 6.399 0 .934-.027 1.74-.08 2.42-.054.681-.22 1.534-.5 2.561-.28 1.026-.66 1.866-1.14 2.52-.48.654-1.213 1.227-2.2 1.72-.987.494-2.16.74-3.52.74h-7.04V39zm0-12h6.68c.96 0 1.773-.187 2.44-.56.666-.374 1.153-.773 1.46-1.2.306-.427.546-1.04.72-1.84.173-.801.267-1.4.28-1.801.013-.399.02-.973.02-1.72 0-4.053-1.694-6.08-5.08-6.08h-6.52V27zM29.48 33.92l2.8-.12c.106.987.6 1.754 1.48 2.3.88.547 1.893.82 3.04.82s2.14-.26 2.98-.78c.84-.52 1.26-1.266 1.26-2.239s-.36-1.747-1.08-2.32c-.72-.573-1.6-1.026-2.64-1.36-1.04-.333-2.086-.686-3.14-1.06a7.36 7.36 0 01-2.78-1.76c-.987-.934-1.48-2.073-1.48-3.42s.54-2.601 1.62-3.761 2.833-1.739 5.26-1.739c.854 0 1.653.1 2.4.3.746.2 1.28.394 1.6.58l.48.279-.92 2.521c-.854-.666-1.974-1-3.36-1-1.387 0-2.42.26-3.1.78-.68.52-1.02 1.18-1.02 1.979 0 .88.426 1.574 1.28 2.08.853.507 1.813.934 2.88 1.28 1.066.347 2.126.733 3.18 1.16 1.053.427 1.946 1.094 2.68 2s1.1 2.106 1.1 3.6c0 1.494-.6 2.794-1.8 3.9-1.2 1.106-2.954 1.66-5.26 1.66-2.307 0-4.114-.547-5.42-1.64-1.307-1.093-1.987-2.44-2.04-4.04z"
                                              fill="#c1dbe6" data-original="#89d3ff"/>
                                    </g>
                                </svg>
                                Photoshop
                            </div>
                            <span class="status">
                <span class="status-circle green"></span>
                Updated</span>
                            <div class="button-wrapper">
                                <button class="content-button status-button open">Open</button>
                                <div class="menu">
                                    <button class="dropdown">
                                        <ul>
                                            <li><a href="#">Go to Discover</a></li>
                                            <li><a href="#">Learn more</a></li>
                                            <li><a href="#">Uninstall</a></li>
                                        </ul>
                                    </button>
                                </div>
                            </div>
                        </li>
                        <li class="adobe-product">
                            <div class="products">
                                <svg viewBox="0 0 52 52" style="border:1px solid #b65a0b">
                                    <g xmlns="http://www.w3.org/2000/svg">
                                        <path d="M40.824 52H11.176C5.003 52 0 46.997 0 40.824V11.176C0 5.003 5.003 0 11.176 0h29.649C46.997 0 52 5.003 52 11.176v29.649C52 46.997 46.997 52 40.824 52z"
                                              fill="#261400" data-original="#6d4c13"/>
                                        <path d="M30.68 39h-3.24l-2.76-9.04h-8.32L13.72 39H10.6l8.24-28h3.32l8.52 28zm-6.72-12l-3.48-11.36L17.12 27h6.84zM37.479 12.24c0 .453-.16.84-.48 1.16-.32.319-.7.479-1.14.479-.44 0-.827-.166-1.16-.5-.334-.333-.5-.713-.5-1.14s.166-.807.5-1.141c.333-.333.72-.5 1.16-.5.44 0 .82.16 1.14.48.321.322.48.709.48 1.162zM37.24 39h-2.88V18.96h2.88V39z"
                                              fill="#e6d2c0" data-original="#ffbd2e"/>
                                    </g>
                                </svg>
                                Illustrator
                            </div>
                            <span class="status">
                <span class="status-circle"></span>
                Update Available</span>
                            <div class="button-wrapper">
                                <button class="content-button">Update this app</button>
                                <div class="pop-up">
                                    <div class="pop-up__title">Update This App
                                        <svg class="close" width="24" height="24" fill="none" stroke="currentColor"
                                             stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                             class="feather feather-x-circle">
                                            <circle cx="12" cy="12" r="10"/>
                                            <path d="M15 9l-6 6M9 9l6 6"/>
                                        </svg>
                                    </div>
                                    <div class="pop-up__subtitle">Adjust your selections for advanced options as desired
                                        before continuing. <a href="#">Learn more</a></div>
                                    <div class="checkbox-wrapper">
                                        <input type="checkbox" id="check1" class="checkbox">
                                        <label for="check1">Import previous settings and preferences</label>
                                    </div>
                                    <div class="checkbox-wrapper">
                                        <input type="checkbox" id="check2" class="checkbox">
                                        <label for="check2">Remove old versions</label>
                                    </div>
                                    <div class="content-button-wrapper">
                                        <button class="content-button status-button open close">Cancel</button>
                                        <button class="content-button status-button">Continue</button>
                                    </div>
                                </div>
                                <div class="menu">
                                    <button class="dropdown">
                                        <ul>
                                            <li><a href="#">Go to Discover</a></li>
                                            <li><a href="#">Learn more</a></li>
                                            <li><a href="#">Uninstall</a></li>
                                        </ul>
                                    </button>
                                </div>
                            </div>
                        </li>
                        <li class="adobe-product">
                            <div class="products">
                                <svg viewBox="0 0 52 52" style="border: 1px solid #C75DEB">
                                    <g xmlns="http://www.w3.org/2000/svg">
                                        <path d="M40.824 52H11.176C5.003 52 0 46.997 0 40.824V11.176C0 5.003 5.003 0 11.176 0h29.649C46.997 0 52 5.003 52 11.176v29.649C52 46.997 46.997 52 40.824 52z"
                                              fill="#3a3375" data-original="#3a3375"/>
                                        <path d="M27.44 39H24.2l-2.76-9.04h-8.32L10.48 39H7.36l8.24-28h3.32l8.52 28zm-6.72-12l-3.48-11.36L13.88 27h6.84zM31.48 33.48c0 2.267 1.333 3.399 4 3.399 1.653 0 3.466-.546 5.44-1.64L42 37.6c-2.054 1.254-4.2 1.881-6.44 1.881-4.64 0-6.96-1.946-6.96-5.841v-8.2c0-2.16.673-3.841 2.02-5.04 1.346-1.2 3.126-1.801 5.34-1.801s3.94.594 5.18 1.78c1.24 1.187 1.86 2.834 1.86 4.94V30.8l-11.52.6v2.08zm8.6-5.24v-3.08c0-1.413-.44-2.42-1.32-3.021-.88-.6-1.907-.899-3.08-.899-1.174 0-2.167.359-2.98 1.08-.814.72-1.22 1.773-1.22 3.16v3.199l8.6-.439z"
                                              fill="#e4d1eb" data-original="#e7adfb"/>
                                    </g>
                                </svg>
                                After Effects
                            </div>
                            <span class="status">
                <span class="status-circle green"></span>
                Updated</span>
                            <div class="button-wrapper">
                                <button class="content-button status-button open">Open</button>
                                <div class="menu">
                                    <button class="dropdown">
                                        <ul>
                                            <li><a href="#">Go to Discover</a></li>
                                            <li><a href="#">Learn more</a></li>
                                            <li><a href="#">Uninstall</a></li>
                                        </ul>
                                    </button>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="content-section">
                    <div class="content-section-title">Apps in your plan</div>
                    <div class="apps-card">
                        <div class="app-card">
              <span>
                <svg viewBox="0 0 512 512" style="border: 1px solid #a059a9">
                  <path xmlns="http://www.w3.org/2000/svg"
                        d="M480 0H32C14.368 0 0 14.368 0 32v448c0 17.664 14.368 32 32 32h448c17.664 0 32-14.336 32-32V32c0-17.632-14.336-32-32-32z"
                        fill="#210027" data-original="#7b1fa2"/>
                  <g xmlns="http://www.w3.org/2000/svg">
                    <path d="M192 64h-80c-8.832 0-16 7.168-16 16v352c0 8.832 7.168 16 16 16s16-7.168 16-16V256h64c52.928 0 96-43.072 96-96s-43.072-96-96-96zm0 160h-64V96h64c35.296 0 64 28.704 64 64s-28.704 64-64 64zM400 256h-32c-18.08 0-34.592 6.24-48 16.384V272c0-8.864-7.168-16-16-16s-16 7.136-16 16v160c0 8.832 7.168 16 16 16s16-7.168 16-16v-96c0-26.464 21.536-48 48-48h32c8.832 0 16-7.168 16-16s-7.168-16-16-16z"
                          fill="#f6e7fa" data-original="#e1bee7"/>
                  </g>
                </svg>
                Premiere Pro
              </span>
                            <div class="app-card__subtext">Edit, master and create fully proffesional videos</div>
                            <div class="app-card-buttons">
                                <button class="content-button status-button">Update</button>
                                <div class="menu"></div>
                            </div>
                        </div>
                        <div class="app-card">
              <span>
                <svg viewBox="0 0 52 52" style="border: 1px solid #c1316d">
                  <g xmlns="http://www.w3.org/2000/svg">
                    <path d="M40.824 52H11.176C5.003 52 0 46.997 0 40.824V11.176C0 5.003 5.003 0 11.176 0h29.649C46.997 0 52 5.003 52 11.176v29.649C52 46.997 46.997 52 40.824 52z"
                          fill="#2f0015" data-original="#6f2b41"/>
                    <path d="M18.08 39H15.2V13.72l-2.64-.08V11h5.52v28zM27.68 19.4c1.173-.507 2.593-.761 4.26-.761s3.073.374 4.22 1.12V11h2.88v28c-2.293.32-4.414.48-6.36.48-1.947 0-3.707-.4-5.28-1.2-2.08-1.066-3.12-2.92-3.12-5.561v-7.56c0-2.799 1.133-4.719 3.4-5.759zm8.48 3.12c-1.387-.746-2.907-1.119-4.56-1.119-1.574 0-2.714.406-3.42 1.22-.707.813-1.06 1.847-1.06 3.1v7.12c0 1.227.44 2.188 1.32 2.88.96.719 2.146 1.079 3.56 1.079 1.413 0 2.8-.106 4.16-.319V22.52z"
                          fill="#e1c1cf" data-original="#ff70bd"/>
                  </g>
                </svg>
                InDesign
              </span>
                            <div class="app-card__subtext">Design and publish great projects & mockups</div>
                            <div class="app-card-buttons">
                                <button class="content-button status-button">Update</button>
                                <div class="menu"></div>
                            </div>
                        </div>
                        <div class="app-card">
              <span>
                <svg viewBox="0 0 52 52" style="border: 1px solid #C75DEB">
                  <g xmlns="http://www.w3.org/2000/svg">
                    <path d="M40.824 52H11.176C5.003 52 0 46.997 0 40.824V11.176C0 5.003 5.003 0 11.176 0h29.649C46.997 0 52 5.003 52 11.176v29.649C52 46.997 46.997 52 40.824 52z"
                          fill="#3a3375" data-original="#3a3375"/>
                    <path d="M27.44 39H24.2l-2.76-9.04h-8.32L10.48 39H7.36l8.24-28h3.32l8.52 28zm-6.72-12l-3.48-11.36L13.88 27h6.84zM31.48 33.48c0 2.267 1.333 3.399 4 3.399 1.653 0 3.466-.546 5.44-1.64L42 37.6c-2.054 1.254-4.2 1.881-6.44 1.881-4.64 0-6.96-1.946-6.96-5.841v-8.2c0-2.16.673-3.841 2.02-5.04 1.346-1.2 3.126-1.801 5.34-1.801s3.94.594 5.18 1.78c1.24 1.187 1.86 2.834 1.86 4.94V30.8l-11.52.6v2.08zm8.6-5.24v-3.08c0-1.413-.44-2.42-1.32-3.021-.88-.6-1.907-.899-3.08-.899-1.174 0-2.167.359-2.98 1.08-.814.72-1.22 1.773-1.22 3.16v3.199l8.6-.439z"
                          fill="#e4d1eb" data-original="#e7adfb"/>
                  </g>
                </svg>
                After Effects
              </span>
                            <div class="app-card__subtext">Industry Standart motion graphics & visual effects</div>
                            <div class="app-card-buttons">
                                <button class="content-button status-button">Update</button>
                                <div class="menu"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-wrapper " id="_4">
                <div class="content-wrapper-header">
                    <div class="content-wrapper-context">
                        <h3 class="img-content">
                            <svg viewBox="0 0 512 512">
                                <path d="M467 0H45C20.099 0 0 20.099 0 45v422c0 24.901 20.099 45 45 45h422c24.901 0 45-20.099 45-45V45c0-24.901-20.099-45-45-45z"
                                      fill="#d6355b" data-original="#ff468c"/>
                                <path xmlns="http://www.w3.org/2000/svg"
                                      d="M512 45v422c0 24.901-20.099 45-45 45H256V0h211c24.901 0 45 20.099 45 45z"
                                      fill="#d6355b" data-original="#d72878"/>
                                <path xmlns="http://www.w3.org/2000/svg"
                                      d="M467 30H45c-8.401 0-15 6.599-15 15v422c0 8.401 6.599 15 15 15h422c8.401 0 15-6.599 15-15V45c0-8.401-6.599-15-15-15z"
                                      fill="#2e000a" data-original="#700029"/>
                                <path xmlns="http://www.w3.org/2000/svg"
                                      d="M482 45v422c0 8.401-6.599 15-15 15H256V30h211c8.401 0 15 6.599 15 15z"
                                      fill="#2e000a" data-original="#4d0e06"/>
                                <path xmlns="http://www.w3.org/2000/svg"
                                      d="M181 391c-41.353 0-75-33.647-75-75 0-8.291 6.709-15 15-15s15 6.709 15 15c0 24.814 20.186 45 45 45s45-20.186 45-45-20.186-45-45-45c-41.353 0-75-33.647-75-75s33.647-75 75-75 75 33.647 75 75c0 8.291-6.709 15-15 15s-15-6.709-15-15c0-24.814-20.186-45-45-45s-45 20.186-45 45 20.186 45 45 45c41.353 0 75 33.647 75 75s-33.647 75-75 75z"
                                      fill="#d6355b" data-original="#ff468c"/>
                                <path xmlns="http://www.w3.org/2000/svg"
                                      d="M391 361h-30c-8.276 0-15-6.724-15-15V211h45c8.291 0 15-6.709 15-15s-6.709-15-15-15h-45v-45c0-8.291-6.709-15-15-15s-15 6.709-15 15v45h-15c-8.291 0-15 6.709-15 15s6.709 15 15 15h15v135c0 24.814 20.186 45 45 45h30c8.291 0 15-6.709 15-15s-6.709-15-15-15z"
                                      fill="#d6355b" data-original="#d72878"/>
                            </svg>
                            Adobe Stock
                        </h3>
                        <div class="content-text">Grab yourself 10 free images from Adobe Stock in a 30-day free trial
                            plan and find perfect image, that will help you with your new project.
                        </div>
                        <button class="content-button">Start free trial</button>
                    </div>
                    <img class="content-wrapper-img" src="https://assets.codepen.io/3364143/glass.png" alt="">
                </div>
                <div class="content-section">
                    <div class="content-section-title">Installed</div>
                    <ul>
                        <li class="adobe-product">
                            <div class="products">
                                <svg viewBox="0 0 52 52" style="border:1px solid #3291b8">
                                    <g xmlns="http://www.w3.org/2000/svg">
                                        <path d="M40.824 52H11.176C5.003 52 0 46.997 0 40.824V11.176C0 5.003 5.003 0 11.176 0h29.649C46.997 0 52 5.003 52 11.176v29.649C52 46.997 46.997 52 40.824 52z"
                                              fill="#061e26" data-original="#393687"/>
                                        <path d="M12.16 39H9.28V11h9.64c2.613 0 4.553.813 5.82 2.44 1.266 1.626 1.9 3.76 1.9 6.399 0 .934-.027 1.74-.08 2.42-.054.681-.22 1.534-.5 2.561-.28 1.026-.66 1.866-1.14 2.52-.48.654-1.213 1.227-2.2 1.72-.987.494-2.16.74-3.52.74h-7.04V39zm0-12h6.68c.96 0 1.773-.187 2.44-.56.666-.374 1.153-.773 1.46-1.2.306-.427.546-1.04.72-1.84.173-.801.267-1.4.28-1.801.013-.399.02-.973.02-1.72 0-4.053-1.694-6.08-5.08-6.08h-6.52V27zM29.48 33.92l2.8-.12c.106.987.6 1.754 1.48 2.3.88.547 1.893.82 3.04.82s2.14-.26 2.98-.78c.84-.52 1.26-1.266 1.26-2.239s-.36-1.747-1.08-2.32c-.72-.573-1.6-1.026-2.64-1.36-1.04-.333-2.086-.686-3.14-1.06a7.36 7.36 0 01-2.78-1.76c-.987-.934-1.48-2.073-1.48-3.42s.54-2.601 1.62-3.761 2.833-1.739 5.26-1.739c.854 0 1.653.1 2.4.3.746.2 1.28.394 1.6.58l.48.279-.92 2.521c-.854-.666-1.974-1-3.36-1-1.387 0-2.42.26-3.1.78-.68.52-1.02 1.18-1.02 1.979 0 .88.426 1.574 1.28 2.08.853.507 1.813.934 2.88 1.28 1.066.347 2.126.733 3.18 1.16 1.053.427 1.946 1.094 2.68 2s1.1 2.106 1.1 3.6c0 1.494-.6 2.794-1.8 3.9-1.2 1.106-2.954 1.66-5.26 1.66-2.307 0-4.114-.547-5.42-1.64-1.307-1.093-1.987-2.44-2.04-4.04z"
                                              fill="#c1dbe6" data-original="#89d3ff"/>
                                    </g>
                                </svg>
                                Photoshop
                            </div>
                            <span class="status">
                <span class="status-circle green"></span>
                Updated</span>
                            <div class="button-wrapper">
                                <button class="content-button status-button open">Open</button>
                                <div class="menu">
                                    <button class="dropdown">
                                        <ul>
                                            <li><a href="#">Go to Discover</a></li>
                                            <li><a href="#">Learn more</a></li>
                                            <li><a href="#">Uninstall</a></li>
                                        </ul>
                                    </button>
                                </div>
                            </div>
                        </li>
                        <li class="adobe-product">
                            <div class="products">
                                <svg viewBox="0 0 52 52" style="border:1px solid #b65a0b">
                                    <g xmlns="http://www.w3.org/2000/svg">
                                        <path d="M40.824 52H11.176C5.003 52 0 46.997 0 40.824V11.176C0 5.003 5.003 0 11.176 0h29.649C46.997 0 52 5.003 52 11.176v29.649C52 46.997 46.997 52 40.824 52z"
                                              fill="#261400" data-original="#6d4c13"/>
                                        <path d="M30.68 39h-3.24l-2.76-9.04h-8.32L13.72 39H10.6l8.24-28h3.32l8.52 28zm-6.72-12l-3.48-11.36L17.12 27h6.84zM37.479 12.24c0 .453-.16.84-.48 1.16-.32.319-.7.479-1.14.479-.44 0-.827-.166-1.16-.5-.334-.333-.5-.713-.5-1.14s.166-.807.5-1.141c.333-.333.72-.5 1.16-.5.44 0 .82.16 1.14.48.321.322.48.709.48 1.162zM37.24 39h-2.88V18.96h2.88V39z"
                                              fill="#e6d2c0" data-original="#ffbd2e"/>
                                    </g>
                                </svg>
                                Illustrator
                            </div>
                            <span class="status">
                <span class="status-circle"></span>
                Update Available</span>
                            <div class="button-wrapper">
                                <button class="content-button">Update this app</button>

                                <div class="menu">
                                    <button class="dropdown">
                                        <ul>
                                            <li><a href="#">Go to Discover</a></li>
                                            <li><a href="#">Learn more</a></li>
                                            <li><a href="#">Uninstall</a></li>
                                        </ul>
                                    </button>
                                </div>
                            </div>
                        </li>
                        <li class="adobe-product">
                            <div class="products">
                                <svg viewBox="0 0 52 52" style="border: 1px solid #C75DEB">
                                    <g xmlns="http://www.w3.org/2000/svg">
                                        <path d="M40.824 52H11.176C5.003 52 0 46.997 0 40.824V11.176C0 5.003 5.003 0 11.176 0h29.649C46.997 0 52 5.003 52 11.176v29.649C52 46.997 46.997 52 40.824 52z"
                                              fill="#3a3375" data-original="#3a3375"/>
                                        <path d="M27.44 39H24.2l-2.76-9.04h-8.32L10.48 39H7.36l8.24-28h3.32l8.52 28zm-6.72-12l-3.48-11.36L13.88 27h6.84zM31.48 33.48c0 2.267 1.333 3.399 4 3.399 1.653 0 3.466-.546 5.44-1.64L42 37.6c-2.054 1.254-4.2 1.881-6.44 1.881-4.64 0-6.96-1.946-6.96-5.841v-8.2c0-2.16.673-3.841 2.02-5.04 1.346-1.2 3.126-1.801 5.34-1.801s3.94.594 5.18 1.78c1.24 1.187 1.86 2.834 1.86 4.94V30.8l-11.52.6v2.08zm8.6-5.24v-3.08c0-1.413-.44-2.42-1.32-3.021-.88-.6-1.907-.899-3.08-.899-1.174 0-2.167.359-2.98 1.08-.814.72-1.22 1.773-1.22 3.16v3.199l8.6-.439z"
                                              fill="#e4d1eb" data-original="#e7adfb"/>
                                    </g>
                                </svg>
                                After Effects
                            </div>
                            <span class="status">
                <span class="status-circle green"></span>
                Updated</span>
                            <div class="button-wrapper">
                                <button class="content-button status-button open">Open</button>
                                <div class="menu">
                                    <button class="dropdown">
                                        <ul>
                                            <li><a href="#">Go to Discover</a></li>
                                            <li><a href="#">Learn more</a></li>
                                            <li><a href="#">Uninstall</a></li>
                                        </ul>
                                    </button>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="content-section">
                    <div class="content-section-title">Apps in your plan</div>
                    <div class="apps-card">
                        <div class="app-card">
              <span>
                <svg viewBox="0 0 512 512" style="border: 1px solid #a059a9">
                  <path xmlns="http://www.w3.org/2000/svg"
                        d="M480 0H32C14.368 0 0 14.368 0 32v448c0 17.664 14.368 32 32 32h448c17.664 0 32-14.336 32-32V32c0-17.632-14.336-32-32-32z"
                        fill="#210027" data-original="#7b1fa2"/>
                  <g xmlns="http://www.w3.org/2000/svg">
                    <path d="M192 64h-80c-8.832 0-16 7.168-16 16v352c0 8.832 7.168 16 16 16s16-7.168 16-16V256h64c52.928 0 96-43.072 96-96s-43.072-96-96-96zm0 160h-64V96h64c35.296 0 64 28.704 64 64s-28.704 64-64 64zM400 256h-32c-18.08 0-34.592 6.24-48 16.384V272c0-8.864-7.168-16-16-16s-16 7.136-16 16v160c0 8.832 7.168 16 16 16s16-7.168 16-16v-96c0-26.464 21.536-48 48-48h32c8.832 0 16-7.168 16-16s-7.168-16-16-16z"
                          fill="#f6e7fa" data-original="#e1bee7"/>
                  </g>
                </svg>
                Premiere Pro
              </span>
                            <div class="app-card__subtext">Edit, master and create fully proffesional videos</div>
                            <div class="app-card-buttons">
                                <button class="content-button status-button">Update</button>
                                <div class="menu"></div>
                            </div>
                        </div>
                        <div class="app-card">
              <span>
                <svg viewBox="0 0 52 52" style="border: 1px solid #c1316d">
                  <g xmlns="http://www.w3.org/2000/svg">
                    <path d="M40.824 52H11.176C5.003 52 0 46.997 0 40.824V11.176C0 5.003 5.003 0 11.176 0h29.649C46.997 0 52 5.003 52 11.176v29.649C52 46.997 46.997 52 40.824 52z"
                          fill="#2f0015" data-original="#6f2b41"/>
                    <path d="M18.08 39H15.2V13.72l-2.64-.08V11h5.52v28zM27.68 19.4c1.173-.507 2.593-.761 4.26-.761s3.073.374 4.22 1.12V11h2.88v28c-2.293.32-4.414.48-6.36.48-1.947 0-3.707-.4-5.28-1.2-2.08-1.066-3.12-2.92-3.12-5.561v-7.56c0-2.799 1.133-4.719 3.4-5.759zm8.48 3.12c-1.387-.746-2.907-1.119-4.56-1.119-1.574 0-2.714.406-3.42 1.22-.707.813-1.06 1.847-1.06 3.1v7.12c0 1.227.44 2.188 1.32 2.88.96.719 2.146 1.079 3.56 1.079 1.413 0 2.8-.106 4.16-.319V22.52z"
                          fill="#e1c1cf" data-original="#ff70bd"/>
                  </g>
                </svg>
                InDesign
              </span>
                            <div class="app-card__subtext">Design and publish great projects & mockups</div>
                            <div class="app-card-buttons">
                                <button class="content-button status-button">Update</button>
                                <div class="menu"></div>
                            </div>
                        </div>
                        <div class="app-card">
              <span>
                <svg viewBox="0 0 52 52" style="border: 1px solid #C75DEB">
                  <g xmlns="http://www.w3.org/2000/svg">
                    <path d="M40.824 52H11.176C5.003 52 0 46.997 0 40.824V11.176C0 5.003 5.003 0 11.176 0h29.649C46.997 0 52 5.003 52 11.176v29.649C52 46.997 46.997 52 40.824 52z"
                          fill="#3a3375" data-original="#3a3375"/>
                    <path d="M27.44 39H24.2l-2.76-9.04h-8.32L10.48 39H7.36l8.24-28h3.32l8.52 28zm-6.72-12l-3.48-11.36L13.88 27h6.84zM31.48 33.48c0 2.267 1.333 3.399 4 3.399 1.653 0 3.466-.546 5.44-1.64L42 37.6c-2.054 1.254-4.2 1.881-6.44 1.881-4.64 0-6.96-1.946-6.96-5.841v-8.2c0-2.16.673-3.841 2.02-5.04 1.346-1.2 3.126-1.801 5.34-1.801s3.94.594 5.18 1.78c1.24 1.187 1.86 2.834 1.86 4.94V30.8l-11.52.6v2.08zm8.6-5.24v-3.08c0-1.413-.44-2.42-1.32-3.021-.88-.6-1.907-.899-3.08-.899-1.174 0-2.167.359-2.98 1.08-.814.72-1.22 1.773-1.22 3.16v3.199l8.6-.439z"
                          fill="#e4d1eb" data-original="#e7adfb"/>
                  </g>
                </svg>
                After Effects
              </span>
                            <div class="app-card__subtext">Industry Standart motion graphics & visual effects</div>
                            <div class="app-card-buttons">
                                <button class="content-button status-button">Update</button>
                                <div class="menu"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php if (is_adm()) {
                echo '<div class="content-wrapper" id="m-side_2_">
                <div class="content-wrapper-header">
                    <div class="content-wrapper-context">
                        <h3 class="img-content">
                            <svg viewBox="0 0 512 512">
                                <path d="M467 0H45C20.099 0 0 20.099 0 45v422c0 24.901 20.099 45 45 45h422c24.901 0 45-20.099 45-45V45c0-24.901-20.099-45-45-45z"
                                      fill="#d6355b" data-original="#ff468c"/>
                                <path xmlns="http://www.w3.org/2000/svg"
                                      d="M512 45v422c0 24.901-20.099 45-45 45H256V0h211c24.901 0 45 20.099 45 45z"
                                      fill="#d6355b" data-original="#d72878"/>
                                <path xmlns="http://www.w3.org/2000/svg"
                                      d="M467 30H45c-8.401 0-15 6.599-15 15v422c0 8.401 6.599 15 15 15h422c8.401 0 15-6.599 15-15V45c0-8.401-6.599-15-15-15z"
                                      fill="#2e000a" data-original="#700029"/>
                                <path xmlns="http://www.w3.org/2000/svg"
                                      d="M482 45v422c0 8.401-6.599 15-15 15H256V30h211c8.401 0 15 6.599 15 15z"
                                      fill="#2e000a" data-original="#4d0e06"/>
                                <path xmlns="http://www.w3.org/2000/svg"
                                      d="M181 391c-41.353 0-75-33.647-75-75 0-8.291 6.709-15 15-15s15 6.709 15 15c0 24.814 20.186 45 45 45s45-20.186 45-45-20.186-45-45-45c-41.353 0-75-33.647-75-75s33.647-75 75-75 75 33.647 75 75c0 8.291-6.709 15-15 15s-15-6.709-15-15c0-24.814-20.186-45-45-45s-45 20.186-45 45 20.186 45 45 45c41.353 0 75 33.647 75 75s-33.647 75-75 75z"
                                      fill="#d6355b" data-original="#ff468c"/>
                                <path xmlns="http://www.w3.org/2000/svg"
                                      d="M391 361h-30c-8.276 0-15-6.724-15-15V211h45c8.291 0 15-6.709 15-15s-6.709-15-15-15h-45v-45c0-8.291-6.709-15-15-15s-15 6.709-15 15v45h-15c-8.291 0-15 6.709-15 15s6.709 15 15 15h15v135c0 24.814 20.186 45 45 45h30c8.291 0 15-6.709 15-15s-6.709-15-15-15z"
                                      fill="#d6355b" data-original="#d72878"/>
                            </svg>
                            Adobe Stock
                        </h3>
                        <div class="content-text">Grab yourself 10 free images from Adobe Stock in a 30-day free trial
                            plan and find perfect image, that will help you with your new project.
                        </div>
                        <button class="content-button">Start free trial</button>
                    </div>
                    <img class="content-wrapper-img" src="https://assets.codepen.io/3364143/glass.png" alt="">
                </div>
                <div class="content-section">
                    <div class="content-section-title">Add User</div>
                    <!--           <ul>
                      <li class="adobe-product">
                        <div class="products">
                          <svg viewBox="0 0 52 52" style="border:1px solid #3291b8">
                            <g xmlns="http://www.w3.org/2000/svg">
                              <path d="M40.824 52H11.176C5.003 52 0 46.997 0 40.824V11.176C0 5.003 5.003 0 11.176 0h29.649C46.997 0 52 5.003 52 11.176v29.649C52 46.997 46.997 52 40.824 52z" fill="#061e26" data-original="#393687" />
                              <path d="M12.16 39H9.28V11h9.64c2.613 0 4.553.813 5.82 2.44 1.266 1.626 1.9 3.76 1.9 6.399 0 .934-.027 1.74-.08 2.42-.054.681-.22 1.534-.5 2.561-.28 1.026-.66 1.866-1.14 2.52-.48.654-1.213 1.227-2.2 1.72-.987.494-2.16.74-3.52.74h-7.04V39zm0-12h6.68c.96 0 1.773-.187 2.44-.56.666-.374 1.153-.773 1.46-1.2.306-.427.546-1.04.72-1.84.173-.801.267-1.4.28-1.801.013-.399.02-.973.02-1.72 0-4.053-1.694-6.08-5.08-6.08h-6.52V27zM29.48 33.92l2.8-.12c.106.987.6 1.754 1.48 2.3.88.547 1.893.82 3.04.82s2.14-.26 2.98-.78c.84-.52 1.26-1.266 1.26-2.239s-.36-1.747-1.08-2.32c-.72-.573-1.6-1.026-2.64-1.36-1.04-.333-2.086-.686-3.14-1.06a7.36 7.36 0 01-2.78-1.76c-.987-.934-1.48-2.073-1.48-3.42s.54-2.601 1.62-3.761 2.833-1.739 5.26-1.739c.854 0 1.653.1 2.4.3.746.2 1.28.394 1.6.58l.48.279-.92 2.521c-.854-.666-1.974-1-3.36-1-1.387 0-2.42.26-3.1.78-.68.52-1.02 1.18-1.02 1.979 0 .88.426 1.574 1.28 2.08.853.507 1.813.934 2.88 1.28 1.066.347 2.126.733 3.18 1.16 1.053.427 1.946 1.094 2.68 2s1.1 2.106 1.1 3.6c0 1.494-.6 2.794-1.8 3.9-1.2 1.106-2.954 1.66-5.26 1.66-2.307 0-4.114-.547-5.42-1.64-1.307-1.093-1.987-2.44-2.04-4.04z" fill="#c1dbe6" data-original="#89d3ff" />
                            </g>
                          </svg>
                          Photoshop
                        </div>
                        <span class="status">
                          <span class="status-circle green"></span>
                          Updated</span>
                        <div class="button-wrapper">
                          <button class="content-button status-button open">Open</button>
                          <div class="menu">
                            <button class="dropdown">
                              <ul>
                                <li><a href="#">Go to Discover</a></li>
                                <li><a href="#">Learn more</a></li>
                                <li><a href="#">Uninstall</a></li>
                              </ul>
                            </button>
                          </div>
                        </div>
                      </li>
                      <li class="adobe-product">
                        <div class="products">
                          <svg viewBox="0 0 52 52" style="border:1px solid #b65a0b">
                            <g xmlns="http://www.w3.org/2000/svg">
                              <path d="M40.824 52H11.176C5.003 52 0 46.997 0 40.824V11.176C0 5.003 5.003 0 11.176 0h29.649C46.997 0 52 5.003 52 11.176v29.649C52 46.997 46.997 52 40.824 52z" fill="#261400" data-original="#6d4c13" />
                              <path d="M30.68 39h-3.24l-2.76-9.04h-8.32L13.72 39H10.6l8.24-28h3.32l8.52 28zm-6.72-12l-3.48-11.36L17.12 27h6.84zM37.479 12.24c0 .453-.16.84-.48 1.16-.32.319-.7.479-1.14.479-.44 0-.827-.166-1.16-.5-.334-.333-.5-.713-.5-1.14s.166-.807.5-1.141c.333-.333.72-.5 1.16-.5.44 0 .82.16 1.14.48.321.322.48.709.48 1.162zM37.24 39h-2.88V18.96h2.88V39z" fill="#e6d2c0" data-original="#ffbd2e" />
                            </g>
                          </svg>
                          Illustrator
                        </div>
                        <span class="status">
                          <span class="status-circle"></span>
                          Update Available</span>
                        <div class="button-wrapper">
                          <button class="content-button status-button">Update this app</button>
                          <div class="pop-up">
                            <div class="pop-up__title">Update This App
                              <svg class="close" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-circle">
                                <circle cx="12" cy="12" r="10" />
                                <path d="M15 9l-6 6M9 9l6 6" />
                              </svg>
                            </div>
                            <div class="pop-up__subtitle">Adjust your selections for advanced options as desired before continuing. <a href="#">Learn more</a></div>
                            <div class="checkbox-wrapper">
                              <input type="checkbox" id="check1" class="checkbox">
                              <label for="check1">Import previous settings and preferences</label>
                            </div>
                            <div class="checkbox-wrapper">
                              <input type="checkbox" id="check2" class="checkbox">
                              <label for="check2">Remove old versions</label>
                            </div>
                            <div class="content-button-wrapper">
                              <button class="content-button status-button open close">Cancel</button>
                              <button class="content-button status-button">Continue</button>
                            </div>
                          </div>
                          <div class="menu">
                            <button class="dropdown">
                              <ul>
                                <li><a href="#">Go to Discover</a></li>
                                <li><a href="#">Learn more</a></li>
                                <li><a href="#">Uninstall</a></li>
                              </ul>
                            </button>
                          </div>
                        </div>
                      </li>
                      <li class="adobe-product">
                        <div class="products">
                          <svg viewBox="0 0 52 52" style="border: 1px solid #C75DEB">
                            <g xmlns="http://www.w3.org/2000/svg">
                              <path d="M40.824 52H11.176C5.003 52 0 46.997 0 40.824V11.176C0 5.003 5.003 0 11.176 0h29.649C46.997 0 52 5.003 52 11.176v29.649C52 46.997 46.997 52 40.824 52z" fill="#3a3375" data-original="#3a3375" />
                              <path d="M27.44 39H24.2l-2.76-9.04h-8.32L10.48 39H7.36l8.24-28h3.32l8.52 28zm-6.72-12l-3.48-11.36L13.88 27h6.84zM31.48 33.48c0 2.267 1.333 3.399 4 3.399 1.653 0 3.466-.546 5.44-1.64L42 37.6c-2.054 1.254-4.2 1.881-6.44 1.881-4.64 0-6.96-1.946-6.96-5.841v-8.2c0-2.16.673-3.841 2.02-5.04 1.346-1.2 3.126-1.801 5.34-1.801s3.94.594 5.18 1.78c1.24 1.187 1.86 2.834 1.86 4.94V30.8l-11.52.6v2.08zm8.6-5.24v-3.08c0-1.413-.44-2.42-1.32-3.021-.88-.6-1.907-.899-3.08-.899-1.174 0-2.167.359-2.98 1.08-.814.72-1.22 1.773-1.22 3.16v3.199l8.6-.439z" fill="#e4d1eb" data-original="#e7adfb" />
                            </g>
                          </svg>
                          After Effects
                        </div>
                        <span class="status">
                          <span class="status-circle green"></span>
                          Updated</span>
                        <div class="button-wrapper">
                          <button class="content-button status-button open">Open</button>
                          <div class="menu">
                            <button class="dropdown">
                              <ul>
                                <li><a href="#">Go to Discover</a></li>
                                <li><a href="#">Learn more</a></li>
                                <li><a href="#">Uninstall</a></li>
                              </ul>
                            </button>
                          </div>
                        </div>
                      </li>
                    </ul> -->
                    <div class="search-bar">
                        <input type="text" placeholder="Username" id="User_add_Name" style="background-image:none">
                    </div>
                    <br>
                    <div class="search-bar">
                        <input type="text" id="User_add_Pass" placeholder="password" style="background-image:none">
                    </div>
                    <br>
                    <div class="search-bar">
                        <input type="text" id="User_add_Access" placeholder="access" style="background-image:none">
                    </div>
                </div>
                <button class="btn___" id="add_user">Add</button>
                <div class="add_user_status"></div>
            </div>';
            } ?>

            <?php if (is_adm()) {
                echo '<div class="content-wrapper" id="m-side_3_">
                <div class="content-wrapper-header">
                    <div class="content-wrapper-context">
                        <h3 class="img-content">
                            <svg viewBox="0 0 512 512">
                                <path d="M467 0H45C20.099 0 0 20.099 0 45v422c0 24.901 20.099 45 45 45h422c24.901 0 45-20.099 45-45V45c0-24.901-20.099-45-45-45z"
                                      fill="#d6355b" data-original="#ff468c"/>
                                <path xmlns="http://www.w3.org/2000/svg"
                                      d="M512 45v422c0 24.901-20.099 45-45 45H256V0h211c24.901 0 45 20.099 45 45z"
                                      fill="#d6355b" data-original="#d72878"/>
                                <path xmlns="http://www.w3.org/2000/svg"
                                      d="M467 30H45c-8.401 0-15 6.599-15 15v422c0 8.401 6.599 15 15 15h422c8.401 0 15-6.599 15-15V45c0-8.401-6.599-15-15-15z"
                                      fill="#2e000a" data-original="#700029"/>
                                <path xmlns="http://www.w3.org/2000/svg"
                                      d="M482 45v422c0 8.401-6.599 15-15 15H256V30h211c8.401 0 15 6.599 15 15z"
                                      fill="#2e000a" data-original="#4d0e06"/>
                                <path xmlns="http://www.w3.org/2000/svg"
                                      d="M181 391c-41.353 0-75-33.647-75-75 0-8.291 6.709-15 15-15s15 6.709 15 15c0 24.814 20.186 45 45 45s45-20.186 45-45-20.186-45-45-45c-41.353 0-75-33.647-75-75s33.647-75 75-75 75 33.647 75 75c0 8.291-6.709 15-15 15s-15-6.709-15-15c0-24.814-20.186-45-45-45s-45 20.186-45 45 20.186 45 45 45c41.353 0 75 33.647 75 75s-33.647 75-75 75z"
                                      fill="#d6355b" data-original="#ff468c"/>
                                <path xmlns="http://www.w3.org/2000/svg"
                                      d="M391 361h-30c-8.276 0-15-6.724-15-15V211h45c8.291 0 15-6.709 15-15s-6.709-15-15-15h-45v-45c0-8.291-6.709-15-15-15s-15 6.709-15 15v45h-15c-8.291 0-15 6.709-15 15s6.709 15 15 15h15v135c0 24.814 20.186 45 45 45h30c8.291 0 15-6.709 15-15s-6.709-15-15-15z"
                                      fill="#d6355b" data-original="#d72878"/>
                            </svg>
                            Adobe Stock
                        </h3>
                        <div class="content-text">Grab yourself 10 free images from Adobe Stock in a 30-day free trial
                            plan and find perfect image, that will help you with your new project.
                        </div>
                        <button class="content-button">Start free trial</button>
                    </div>
                    <img class="content-wrapper-img" src="https://assets.codepen.io/3364143/glass.png" alt="">
                </div>
                <div class="content-section">
                    <div class="content-section-title">Delete User</div>
                    <div class="search-bar">
                        <input type="text" id="User_del_Name" placeholder="" style="background-image:none">
                    </div>
                    <br>

                </div>
                <button class="btn___" id="del_user">Delete</button>
                <br>
                <div class="del_user_status">

                </div>
            </div>';
            } ?>

            <div class="content-wrapper" id="m-side_144_">
                <div class="flex_row_" dir="rtl">
                    <div dir="ltr" class="_half _inputss">
                        <div class="search-bar">
                            <input type="text" id="User_change_Name" value="<?php echo $_SESSION['user']; ?>"  style="background-image:none">
                        </div>
                        <br>
                        <div class="search-bar">
                            <input type="password" id="User_change_Pass"  value="<?php echo $_SESSION['pass']; ?>"  style="background-image:none">
                        </div>
                        <br>
                        <div class="search-bar">
                            <input type="password" id="User_change_New_Pass" value="<?php echo $_SESSION['pass'] ?>" style="background-image:none">
                        </div>
                        <br>
                        <button class="btn___2" id="change_" style="float:right;">change it</button>
                        <div class="change_status"></div>
                    </div>
                    <div class="_half _align_center">
                        <div class="avatar-upload">
                            <div class="avatar-edit">
                                <input type='file' id="imageUpload" accept=".png, .jpg, .jpeg"/>
                                <label for="imageUpload"></label>
                            </div>
                            <div class="avatar-preview">
                                <div id="imagePreview" style="background-image: url("<?php echo $obj->get_img($_SESSION['user']) ?>");">
                                </div>
                            </div>

                            <br>
                            <div class="profilestat">

                            </div>

                        </div>
                    
                    </div>

                </div>


            </div>
            <div class="content-wrapper" id="m-side_6_">
                <div class="content-wrapper-header">
                    <div class="content-wrapper-context">
                        <h3 class="img-content">
                            <svg viewBox="0 0 512 512">
                                <path d="M467 0H45C20.099 0 0 20.099 0 45v422c0 24.901 20.099 45 45 45h422c24.901 0 45-20.099 45-45V45c0-24.901-20.099-45-45-45z"
                                      fill="#d6355b" data-original="#ff468c"/>
                                <path xmlns="http://www.w3.org/2000/svg"
                                      d="M512 45v422c0 24.901-20.099 45-45 45H256V0h211c24.901 0 45 20.099 45 45z"
                                      fill="#d6355b" data-original="#d72878"/>
                                <path xmlns="http://www.w3.org/2000/svg"
                                      d="M467 30H45c-8.401 0-15 6.599-15 15v422c0 8.401 6.599 15 15 15h422c8.401 0 15-6.599 15-15V45c0-8.401-6.599-15-15-15z"
                                      fill="#2e000a" data-original="#700029"/>
                                <path xmlns="http://www.w3.org/2000/svg"
                                      d="M482 45v422c0 8.401-6.599 15-15 15H256V30h211c8.401 0 15 6.599 15 15z"
                                      fill="#2e000a" data-original="#4d0e06"/>
                                <path xmlns="http://www.w3.org/2000/svg"
                                      d="M181 391c-41.353 0-75-33.647-75-75 0-8.291 6.709-15 15-15s15 6.709 15 15c0 24.814 20.186 45 45 45s45-20.186 45-45-20.186-45-45-45c-41.353 0-75-33.647-75-75s33.647-75 75-75 75 33.647 75 75c0 8.291-6.709 15-15 15s-15-6.709-15-15c0-24.814-20.186-45-45-45s-45 20.186-45 45 20.186 45 45 45c41.353 0 75 33.647 75 75s-33.647 75-75 75z"
                                      fill="#d6355b" data-original="#ff468c"/>
                                <path xmlns="http://www.w3.org/2000/svg"
                                      d="M391 361h-30c-8.276 0-15-6.724-15-15V211h45c8.291 0 15-6.709 15-15s-6.709-15-15-15h-45v-45c0-8.291-6.709-15-15-15s-15 6.709-15 15v45h-15c-8.291 0-15 6.709-15 15s6.709 15 15 15h15v135c0 24.814 20.186 45 45 45h30c8.291 0 15-6.709 15-15s-6.709-15-15-15z"
                                      fill="#d6355b" data-original="#d72878"/>
                            </svg>
                            Adobe Stock
                        </h3>
                        <div class="content-text">Grab yourself 10 free images from Adobe Stock in a 30-day free trial
                            plan and find perfect image, that will help you with your new project.
                        </div>
                        <button class="content-button">Start free trial</button>
                    </div>
                    <img class="content-wrapper-img" src="https://assets.codepen.io/3364143/glass.png" alt="">
                </div>
                <div class="content-section">
                    <div class="content-section-title">Installed</div>
                    <ul>
                        <li class="adobe-product">
                            <div class="products">
                                <svg viewBox="0 0 52 52" style="border:1px solid #3291b8">
                                    <g xmlns="http://www.w3.org/2000/svg">
                                        <path d="M40.824 52H11.176C5.003 52 0 46.997 0 40.824V11.176C0 5.003 5.003 0 11.176 0h29.649C46.997 0 52 5.003 52 11.176v29.649C52 46.997 46.997 52 40.824 52z"
                                              fill="#061e26" data-original="#393687"/>
                                        <path d="M12.16 39H9.28V11h9.64c2.613 0 4.553.813 5.82 2.44 1.266 1.626 1.9 3.76 1.9 6.399 0 .934-.027 1.74-.08 2.42-.054.681-.22 1.534-.5 2.561-.28 1.026-.66 1.866-1.14 2.52-.48.654-1.213 1.227-2.2 1.72-.987.494-2.16.74-3.52.74h-7.04V39zm0-12h6.68c.96 0 1.773-.187 2.44-.56.666-.374 1.153-.773 1.46-1.2.306-.427.546-1.04.72-1.84.173-.801.267-1.4.28-1.801.013-.399.02-.973.02-1.72 0-4.053-1.694-6.08-5.08-6.08h-6.52V27zM29.48 33.92l2.8-.12c.106.987.6 1.754 1.48 2.3.88.547 1.893.82 3.04.82s2.14-.26 2.98-.78c.84-.52 1.26-1.266 1.26-2.239s-.36-1.747-1.08-2.32c-.72-.573-1.6-1.026-2.64-1.36-1.04-.333-2.086-.686-3.14-1.06a7.36 7.36 0 01-2.78-1.76c-.987-.934-1.48-2.073-1.48-3.42s.54-2.601 1.62-3.761 2.833-1.739 5.26-1.739c.854 0 1.653.1 2.4.3.746.2 1.28.394 1.6.58l.48.279-.92 2.521c-.854-.666-1.974-1-3.36-1-1.387 0-2.42.26-3.1.78-.68.52-1.02 1.18-1.02 1.979 0 .88.426 1.574 1.28 2.08.853.507 1.813.934 2.88 1.28 1.066.347 2.126.733 3.18 1.16 1.053.427 1.946 1.094 2.68 2s1.1 2.106 1.1 3.6c0 1.494-.6 2.794-1.8 3.9-1.2 1.106-2.954 1.66-5.26 1.66-2.307 0-4.114-.547-5.42-1.64-1.307-1.093-1.987-2.44-2.04-4.04z"
                                              fill="#c1dbe6" data-original="#89d3ff"/>
                                    </g>
                                </svg>
                                Photoshop
                            </div>
                            <span class="status">
                <span class="status-circle green"></span>
                Updated</span>
                            <div class="button-wrapper">
                                <button class="content-button status-button open">Open</button>
                                <div class="menu">
                                    <button class="dropdown">
                                        <ul>
                                            <li><a href="#">Go to Discover</a></li>
                                            <li><a href="#">Learn more</a></li>
                                            <li><a href="#">Uninstall</a></li>
                                        </ul>
                                    </button>
                                </div>
                            </div>
                        </li>
                        <li class="adobe-product">
                            <div class="products">
                                <svg viewBox="0 0 52 52" style="border:1px solid #b65a0b">
                                    <g xmlns="http://www.w3.org/2000/svg">
                                        <path d="M40.824 52H11.176C5.003 52 0 46.997 0 40.824V11.176C0 5.003 5.003 0 11.176 0h29.649C46.997 0 52 5.003 52 11.176v29.649C52 46.997 46.997 52 40.824 52z"
                                              fill="#261400" data-original="#6d4c13"/>
                                        <path d="M30.68 39h-3.24l-2.76-9.04h-8.32L13.72 39H10.6l8.24-28h3.32l8.52 28zm-6.72-12l-3.48-11.36L17.12 27h6.84zM37.479 12.24c0 .453-.16.84-.48 1.16-.32.319-.7.479-1.14.479-.44 0-.827-.166-1.16-.5-.334-.333-.5-.713-.5-1.14s.166-.807.5-1.141c.333-.333.72-.5 1.16-.5.44 0 .82.16 1.14.48.321.322.48.709.48 1.162zM37.24 39h-2.88V18.96h2.88V39z"
                                              fill="#e6d2c0" data-original="#ffbd2e"/>
                                    </g>
                                </svg>
                                Illustrator
                            </div>
                            <span class="status">
                <span class="status-circle"></span>
                Update Available</span>
                            <div class="button-wrapper">
                                <button class="content-button status-button">Update this app</button>
                                <div class="pop-up">
                                    <div class="pop-up__title">Update This App
                                        <svg class="close" width="24" height="24" fill="none" stroke="currentColor"
                                             stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                             class="feather feather-x-circle">
                                            <circle cx="12" cy="12" r="10"/>
                                            <path d="M15 9l-6 6M9 9l6 6"/>
                                        </svg>
                                    </div>
                                    <div class="pop-up__subtitle">Adjust your selections for advanced options as desired
                                        before continuing. <a href="#">Learn more</a></div>
                                    <div class="checkbox-wrapper">
                                        <input type="checkbox" id="check1" class="checkbox">
                                        <label for="check1">Import previous settings and preferences</label>
                                    </div>
                                    <div class="checkbox-wrapper">
                                        <input type="checkbox" id="check2" class="checkbox">
                                        <label for="check2">Remove old versions</label>
                                    </div>
                                    <div class="content-button-wrapper">
                                        <button class="content-button status-button open close">Cancel</button>
                                        <button class="content-button status-button">Continue</button>
                                    </div>
                                </div>
                                <div class="menu">
                                    <button class="dropdown">
                                        <ul>
                                            <li><a href="#">Go to Discover</a></li>
                                            <li><a href="#">Learn more</a></li>
                                            <li><a href="#">Uninstall</a></li>
                                        </ul>
                                    </button>
                                </div>
                            </div>
                        </li>
                        <li class="adobe-product">
                            <div class="products">
                                <svg viewBox="0 0 52 52" style="border: 1px solid #C75DEB">
                                    <g xmlns="http://www.w3.org/2000/svg">
                                        <path d="M40.824 52H11.176C5.003 52 0 46.997 0 40.824V11.176C0 5.003 5.003 0 11.176 0h29.649C46.997 0 52 5.003 52 11.176v29.649C52 46.997 46.997 52 40.824 52z"
                                              fill="#3a3375" data-original="#3a3375"/>
                                        <path d="M27.44 39H24.2l-2.76-9.04h-8.32L10.48 39H7.36l8.24-28h3.32l8.52 28zm-6.72-12l-3.48-11.36L13.88 27h6.84zM31.48 33.48c0 2.267 1.333 3.399 4 3.399 1.653 0 3.466-.546 5.44-1.64L42 37.6c-2.054 1.254-4.2 1.881-6.44 1.881-4.64 0-6.96-1.946-6.96-5.841v-8.2c0-2.16.673-3.841 2.02-5.04 1.346-1.2 3.126-1.801 5.34-1.801s3.94.594 5.18 1.78c1.24 1.187 1.86 2.834 1.86 4.94V30.8l-11.52.6v2.08zm8.6-5.24v-3.08c0-1.413-.44-2.42-1.32-3.021-.88-.6-1.907-.899-3.08-.899-1.174 0-2.167.359-2.98 1.08-.814.72-1.22 1.773-1.22 3.16v3.199l8.6-.439z"
                                              fill="#e4d1eb" data-original="#e7adfb"/>
                                    </g>
                                </svg>
                                After Effects
                            </div>
                            <span class="status">
                <span class="status-circle green"></span>
                Updated</span>
                            <div class="button-wrapper">
                                <button class="content-button status-button open">Open</button>
                                <div class="menu">
                                    <button class="dropdown">
                                        <ul>
                                            <li><a href="#">Go to Discover</a></li>
                                            <li><a href="#">Learn more</a></li>
                                            <li><a href="#">Uninstall</a></li>
                                        </ul>
                                    </button>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="content-section">
                    <div class="content-section-title">Apps in your plan</div>
                    <div class="apps-card">
                        <div class="app-card">
              <span>
                <svg viewBox="0 0 512 512" style="border: 1px solid #a059a9">
                  <path xmlns="http://www.w3.org/2000/svg"
                        d="M480 0H32C14.368 0 0 14.368 0 32v448c0 17.664 14.368 32 32 32h448c17.664 0 32-14.336 32-32V32c0-17.632-14.336-32-32-32z"
                        fill="#210027" data-original="#7b1fa2"/>
                  <g xmlns="http://www.w3.org/2000/svg">
                    <path d="M192 64h-80c-8.832 0-16 7.168-16 16v352c0 8.832 7.168 16 16 16s16-7.168 16-16V256h64c52.928 0 96-43.072 96-96s-43.072-96-96-96zm0 160h-64V96h64c35.296 0 64 28.704 64 64s-28.704 64-64 64zM400 256h-32c-18.08 0-34.592 6.24-48 16.384V272c0-8.864-7.168-16-16-16s-16 7.136-16 16v160c0 8.832 7.168 16 16 16s16-7.168 16-16v-96c0-26.464 21.536-48 48-48h32c8.832 0 16-7.168 16-16s-7.168-16-16-16z"
                          fill="#f6e7fa" data-original="#e1bee7"/>
                  </g>
                </svg>
                Premiere Pro
              </span>
                            <div class="app-card__subtext">Edit, master and create fully proffesional videos</div>
                            <div class="app-card-buttons">
                                <button class="content-button status-button">Update</button>
                                <div class="menu"></div>
                            </div>
                        </div>
                        <div class="app-card">
              <span>
                <svg viewBox="0 0 52 52" style="border: 1px solid #c1316d">
                  <g xmlns="http://www.w3.org/2000/svg">
                    <path d="M40.824 52H11.176C5.003 52 0 46.997 0 40.824V11.176C0 5.003 5.003 0 11.176 0h29.649C46.997 0 52 5.003 52 11.176v29.649C52 46.997 46.997 52 40.824 52z"
                          fill="#2f0015" data-original="#6f2b41"/>
                    <path d="M18.08 39H15.2V13.72l-2.64-.08V11h5.52v28zM27.68 19.4c1.173-.507 2.593-.761 4.26-.761s3.073.374 4.22 1.12V11h2.88v28c-2.293.32-4.414.48-6.36.48-1.947 0-3.707-.4-5.28-1.2-2.08-1.066-3.12-2.92-3.12-5.561v-7.56c0-2.799 1.133-4.719 3.4-5.759zm8.48 3.12c-1.387-.746-2.907-1.119-4.56-1.119-1.574 0-2.714.406-3.42 1.22-.707.813-1.06 1.847-1.06 3.1v7.12c0 1.227.44 2.188 1.32 2.88.96.719 2.146 1.079 3.56 1.079 1.413 0 2.8-.106 4.16-.319V22.52z"
                          fill="#e1c1cf" data-original="#ff70bd"/>
                  </g>
                </svg>
                InDesign
              </span>
                            <div class="app-card__subtext">Design and publish great projects & mockups</div>
                            <div class="app-card-buttons">
                                <button class="content-button status-button">Update</button>
                                <div class="menu"></div>
                            </div>
                        </div>
                        <div class="app-card">
              <span>
                <svg viewBox="0 0 52 52" style="border: 1px solid #C75DEB">
                  <g xmlns="http://www.w3.org/2000/svg">
                    <path d="M40.824 52H11.176C5.003 52 0 46.997 0 40.824V11.176C0 5.003 5.003 0 11.176 0h29.649C46.997 0 52 5.003 52 11.176v29.649C52 46.997 46.997 52 40.824 52z"
                          fill="#3a3375" data-original="#3a3375"/>
                    <path d="M27.44 39H24.2l-2.76-9.04h-8.32L10.48 39H7.36l8.24-28h3.32l8.52 28zm-6.72-12l-3.48-11.36L13.88 27h6.84zM31.48 33.48c0 2.267 1.333 3.399 4 3.399 1.653 0 3.466-.546 5.44-1.64L42 37.6c-2.054 1.254-4.2 1.881-6.44 1.881-4.64 0-6.96-1.946-6.96-5.841v-8.2c0-2.16.673-3.841 2.02-5.04 1.346-1.2 3.126-1.801 5.34-1.801s3.94.594 5.18 1.78c1.24 1.187 1.86 2.834 1.86 4.94V30.8l-11.52.6v2.08zm8.6-5.24v-3.08c0-1.413-.44-2.42-1.32-3.021-.88-.6-1.907-.899-3.08-.899-1.174 0-2.167.359-2.98 1.08-.814.72-1.22 1.773-1.22 3.16v3.199l8.6-.439z"
                          fill="#e4d1eb" data-original="#e7adfb"/>
                  </g>
                </svg>
                After Effects
              </span>
                            <div class="app-card__subtext">Industry Standart motion graphics & visual effects</div>
                            <div class="app-card-buttons">
                                <button class="content-button status-button">Update</button>
                                <div class="menu"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="overlay-app"></div>




</body>
</html>