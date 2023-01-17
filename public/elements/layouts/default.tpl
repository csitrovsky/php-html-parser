<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"
          name="viewport">
    <meta content="ie=edge" http-equiv="X-UA-Compatible">
    <title>Веб-сайт с технической поддержкой от Csitrovsky</title>

    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link crossorigin href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css2?family=Inconsolata:wght@200;300;400;500;600;700;800;900&display=swap"
          rel="stylesheet">

    <link crossorigin="anonymous"
          href="https://cdnjs.cloudflare.com/ajax/libs/line-awesome/1.3.0/line-awesome/css/line-awesome.min.css"
          integrity="sha512-vebUliqxrVkBy3gucMhClmyQP9On/HAWQdKDXRaAlb/FKuTbxkjPKUyqVOxAcGwFDka79eTF+YXwfke1h3/wfg=="
          referrerpolicy="no-referrer" rel="stylesheet"/>
    <link href="/resource/styles/layouts/css/QZcRB1Hx59Da2rE6.css?v=1.1.<?= time(); ?>" rel="stylesheet">

    <script crossorigin="anonymous"
            integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ=="
            referrerpolicy="no-referrer"
            src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
</head>
<body>

<script id="template-search" type="text/x-template">
    <div class="content-search">
        <div class="search-block">
            <form action="" class="search-form">
                <section class="search-current">
                    <div class="search-icon">
                        <i class="las la-search"></i>
                    </div>
                    <div class="form">
                        <div class="form-field">
                            <label class="hidden" for="search-input" hidden>
                                <span>Поисковая строка</span>
                            </label>
                            <div class="form-input">
                                <input autocapitalize="off" autocomplete="off" autofocus id="search-input"
                                       maxlength="255" name="search-input" placeholder="Введите адрес Страницы"
                                       spellcheck="false" style="opacity: 1;" type="text" v-bind:value="unknown"
                                       v-on:input="unknown = $event.target.value">
                                <input class="form-readonly" disabled="disabled" readonly="readonly"
                                       style="visibility: hidden;" value="">
                                <div class="search-button-clear">
                                    <i class="las la-times"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-primary btn-large search-button" type="button" @click="get">
                        <span>Найти</span>
                    </button>
                </section>
            </form>
        </div>
        <ul class="search-result">
            <li v-for="(count, tag) in tags" class="tag">
                <div class="item-block">
                    <div>
                        <span class="point">
                            <span>•</span>
                        </span>
                        <code v-html="tag"></code>
                        <code v-html="'(' + count + ')'"></code>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</script>

<div id="root">
    <div class="app-layout scrolling">

        <div id="scrollable">
            <div class="app-content">

                <input checked="checked" class="hidden" id="menu-toggle" name="menu" type="checkbox">
                <div id="overlay">
                    <label for="menu-toggle">
                        <i class="las la cancel"></i>
                    </label>
                </div>

                <div class="app-center">
                    <section class="content">
                        <div class="quick-action buttons">
                            <label class="management" data-menu="send-mailto" for="menu-toggle">
                                <a href="https://csitrovsky.ru" target="_blank"
                                   style="background: var(--dark); color: var(--white) !important;">
                                    <i class="las la-home"></i>
                                </a>
                            </label>
                        </div>
                        <vue-search></vue-search>
                    </section>
                </div>

                <div class="app-cookie" id="cookie-banner">
                    <p class="cookie-description">Csitrovsky.ru использует файлы cookie для персонализации вашего
                        использования на нашем веб-сайте. Продолжая пользоваться этим сайтом, вы соглашаетесь с нашей <a
                                class="cookie-link" href="">политикой использования файлов cookie</a>.</p>
                </div>

            </div>
        </div>

    </div>
</div>

<!-- Vue.js -->
<!-- production version, optimized for size and speed -->
<script src="https://cdn.jsdelivr.net/npm/vue@2"></script>
<script src="https://cdn.jsdelivr.net/npm/vue-scrollto"></script>

<!-- Axios -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.0.0-alpha.1/axios.js"
        integrity="sha512-uplugzeh2/XrRr7RgSloGLHjFV0b4FqUtbT5t9Sa/XcilDr1M3+88u/c+mw6+HepH7M2C5EVmahySsyilVHI/A=="
        crossorigin="anonymous"
        referrerpolicy="no-referrer"></script>

<!-- ... Basic Java Script -->
<script src="/resource/vue/MVJ6xvFnXoFPOkfk.js?v=1.1.<?= time(); ?>" crossorigin="anonymous"></script>

<!-- Instantclick -->
<script crossorigin="anonymous"
        integrity="sha512-K0LA7hRSqNt0GOikeLRmpKEecaOy7uizFEA/b3SMMyGycCy1qRLoezkVbuXQUFVq6pwEjCszMCn3TT4dRRie+g=="
        referrerpolicy="no-referrer"
        src="https://cdnjs.cloudflare.com/ajax/libs/instantclick/3.1.0/instantclick.min.js"></script>
<script data-no-instant>InstantClick.init();</script>

</body>
</html>