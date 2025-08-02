@stack('css')

<link href="{{ asset('dist/css/tabler.css?1744816593') }}" rel="stylesheet" />
<link href="{{ asset('dist/css/tabler-flags.css?1744816593') }}" rel="stylesheet" />
<link href="{{ asset('dist/css/tabler-socials.css?1744816593') }}" rel="stylesheet" />
<link href="{{ asset('dist/css/tabler-payments.css?1744816593') }}" rel="stylesheet" />
<link href="{{ asset('dist/css/tabler-vendors.css?1744816593') }}" rel="stylesheet" />
<link href="{{ asset('dist/css/tabler-marketing.css?1744816593') }}" rel="stylesheet" />
<link href="{{ asset('dist/css/tabler-themes.css?1744816593') }}" rel="stylesheet" />
<link href="{{ asset('preview/css/demo.css?1744816593') }}" rel="stylesheet" />

<style>
    @import url("https://rsms.me/inter/inter.css");

    .text-justify {
        text-align: justify;
    }

    .disable-click {
        pointer-events: none;
        cursor: not-allowed;
        color: gray;
    }

    .only-desktop {
        display: block;
    }

    .only-mobile {
        display: none;
    }

    @media (max-width: 800px) {
        .only-desktop {
            display: none;
        }
    }

    @media (max-width: 800px) {
        .only-mobile {
            display: block;
        }
    }

    /* Bottom Menu */
    .bottom-menu {
        position: fixed;
        bottom: 0;
        left: 0;
        width: 100%;
        background: white;
        box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.1);
        border-top: 1px solid #ddd;
        display: flex;
        justify-content: space-around;
        padding: 10px 0;
        z-index: 9999;
    }

    .menu-item {
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        color: #555;
        font-size: 12px;
        flex: 1;
        background: none;
        border: none;
        outline: none;
        cursor: pointer;
    }

    .menu-item.active {
        color: #007bff;
    }

    .menu-item:hover {
        color: #007bff;
    }

    .menu-item svg {
        width: 24px;
        height: 24px;
        margin-bottom: 5px;
    }

    /* Preloader container */
    #preloader {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(255, 255, 255, 0.8);
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 9999;
    }

    /* Spinner */
    .spinner {
        width: 56px;
        height: 56px;
        display: grid;
        animation: spinner-plncf9 4s infinite;
    }

    .spinner::before,
    .spinner::after {
        content: "";
        grid-area: 1/1;
        border: 9px solid;
        border-radius: 50%;
        border-color: #066fd1 #066fd1 #0000 #0000;
        mix-blend-mode: darken;
        animation: spinner-plncf9 1s infinite linear;
    }

    .spinner::after {
        border-color: #0000 #0000 #dbdcef #dbdcef;
        animation-direction: reverse;
    }

    @keyframes spinner-plncf9 {
        100% {
            transform: rotate(1turn);
        }
    }
</style>