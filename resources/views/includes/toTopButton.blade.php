<style>
    #btn-back-to-top {
        position: fixed;
        bottom: 25px;
        display: none;
        background-color: transparent;
        right: 25px;
        z-index: 100;
        background-color: #bd2130 !important;
        border-radius: 0.25rem;
    }

    #btn-back-to-top .bi-arrow-up {
        fill: white;
    }

    html {
        scroll-behavior: smooth;
    }
</style>

<!-- Back to top button -->
<button type="button" class="btn btn-floating btn-lg bg-danger text-light" id="btn-back-to-top">
    <i> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="red" class="bi bi-arrow-up" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M8 15a.5.5 0 0 0 .5-.5V2.707l3.146 3.147a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 1 0 .708.708L7.5 2.707V14.5a.5.5 0 0 0 .5.5z" />
        </svg></i>
</button>

<script type="text/javascript" src="{{ asset('js/toTopButton.js') }}"></script>