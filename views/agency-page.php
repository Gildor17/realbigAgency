<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>

    html,
    body {
        margin: 0;
        height: 100%;
        line-height: 1.15;
        color: #424242;
    }

    .rbag-wrap * {
        font-family: 'ProximaNova', 'Arial', sans-serif !important;
    }

    .rbag-wrap {
        display: flex;
        flex-direction: column;
        min-height: 100%;
        height: 100%;
        position: relative;
        z-index: 3;
    }

    .rbag-main {
        flex: 1 0 auto;
        background: #ffffff;
    }

    * {
        outline: 0;
        box-sizing: border-box;
    }

    a {
        text-decoration: none;
    }

    a:hover,
    a:focus {
        text-decoration: none;
    }

    /*-- CONTAINER --*/

    .rbag-container {
        padding: 0 15px;
        margin: 0 auto;
        max-width: 100vw;
        width: auto !important;
    }

    @media (min-width: 768px) {
        .rbag-container {
            max-width: 750px;
        }
    }

    @media (min-width: 992px) {
        .rbag-container {
            max-width: 970px;
        }
    }

    @media (min-width: 1201px) {
        .rbag-container {
            max-width: 1200px;
        }
    }

    @media (min-width: 1601px) {
        .rbag-container {
            max-width: 1720px;
        }
    }

    /*-- END CONTAINER --*/

    /*-- GENERAL --*/

    .rbag-flex-wrap {
        display: flex;
        flex-wrap: wrap;
    }

    .rbag-center-all-flex {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .rbag-flex-end {
        display: flex;
        justify-content: flex-end;
        align-items: center;
    }

    .rbag-center-flex {
        display: flex;
        align-items: center;
    }

    .rbag-flex-column {
        display: flex;
        flex-direction: column;
    }

    .rbag-few-blocks {
        margin-left: -15px;
        margin-right: -15px;
    }

    .rbag-few-blocks>* {
        padding-left: 15px;
        padding-right: 15px;
    }

    .rbag-few-blocks.rbag-with-wrap {
        margin-top: -15px;
        margin-bottom: -15px;
    }

    .rbag-few-blocks.rbag-with-wrap>* {
        padding-top: 15px;
        padding-bottom: 15px;
    }

    .rbag-width-whole {
        width: 100%;
    }

    .rbag-height-whole {
        height: 100%;
    }
    .rbag-text-center {
        text-align: center;
    }

    .rbag-block-double-margin-bottom {
        margin-bottom: 60px;
    }

    .rbag-block-little-margin-bottom {
        margin-bottom: 10px;
    }

    .rbag-hidden {
        overflow: hidden;
    }

    /*-- END GENERAL --*/

    /*-- ALL --*/

    .rbag-section.rbag-with-spaces {
        padding: 120px 0;
    }

    .rbag-primary-btn {
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 58px;
        max-width: 175px;
        outline: 0;
        border: 0;
        background: #3761EA;
        box-shadow: 0px 100px 167px rgba(76, 79, 238, 0.3), 0px 30.1471px 50.3456px rgba(76, 79, 238, 0.195477), 0px 12.5216px 20.911px rgba(76, 79, 238, 0.15), 0px 4.5288px 7.5631px rgba(76, 79, 238, 0.104523);
        border-radius: 50px;
        padding: 15px 30px;
        letter-spacing: 0.01em;
        color: #FFFFFF !important;
        outline: 0;
        font-weight: 600;
        font-size: 16px;
        cursor: pointer;
        margin: 0;
        margin-top: 40px;
        transition: .2s;
    }

    a.rbag-primary-btn:hover {
        background: #4b75ff;
        color: #FFFFFF;
    }

    .rbag-top-main-info {
        background-color: #171940;
        background-image: url(https://realbig.agency/images/wp/info_img_back.png);
        background-repeat: no-repeat;
        background-position: 110% -100px;
        backdrop-filter: blur(2px);
        padding: 180px 0;
    }

    .rbag-top-main-info h1 {
        font-weight: 600;
        font-size: 54px;
        line-height: 68px;
        color: #FFFFFF;
        margin: 0;
    }

    .rbag-social-links {
        display: flex;
        margin-top: 90px;
    }

    .rbag-social-links a {
        width: 48px;
        height: 48px;
        background: url("https://realbig.agency/images/wp/social_back.svg") no-repeat;
        display: block;
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        background-size: contain;
        -webkit-backface-visibility: hidden;
        -moz-backface-visibility: hidden;
        -ms-backface-visibility: hidden;
        transform: scale(1);
        transition: .2s linear;
        transform: translate3d(0, 0, 0);
    }

    .rbag-social-links a:hover {
        transform: scale(1.07);
    }

    .rbag-social-links>*:not(:last-child) {
        margin-right: 20px;
    }

    .rbag-social-links a:before {
        content: '';
        position: absolute;
        display: block;
        background-repeat: no-repeat;
        background-size: contain;
        width: 15px;
        height: 15px;
    }

    .rbag-social-links a.telegram:before {
        background-image: url('https://realbig.agency/images/wp/telegram.svg');
       
    }

    .rbag-social-links a.facebook:before {
        background-image: url('https://realbig.agency/images/wp/facebook.svg');
       
    }

    .rbag-social-links a.viber:before {
        background-image: url('https://realbig.agency/images/wp/viber.svg');
        
    }

    .rbag-title {
        font-weight: 600;
        font-size: 38px;
        color: #171940;
    }

    .rbag-title.rbag-less-font {
        font-size: 36px;
    }

    .rbag-title.rbag-more-less-font {
        font-size: 26px;
        font-weight: 400;
    }

    .rbag-arrow {
        position: relative;
        width: 20px;
        height: 2px;
        background: #ffffff;
        display: block;
        margin-left: 10px;
        flex: none;
    }

    .rbag-arrow:before {
        content: '';
        border: solid #ffffff;
        border-width: 2px 2px 0 0;
        transform: rotate(45deg);
        display: block;
        width: 6px;
        height: 6px;
        position: absolute;
        right: 0;
        top: -3px;
    }

    .rbag-gray-text {
        font-size: 22px;
        line-height: 30px;
        color: #525F7F;
    }

    .rbag-gray-text.rbag-less-font {
        font-size: 18px;
        line-height: 26px;
    }

    .rbag-digital-rating-block {
        padding-top: 120px;
    }

    .rbag-digital-rating-item {
        background: #FFFFFF;
        border: 1px solid rgba(23, 25, 64, 0.1);
        box-sizing: border-box;
        border-radius: 20px;
        padding: 75px 0px;
        position: relative;
    }

    .rbag-digital-rating-item .img {
        display: flex;
        justify-content: center;
        position: absolute;
    }

    .rbag-digital-rating-item .img img {
        width: 70%;
    }

    .rbag-digital-rating-item.views .img {
        bottom: 80%;
    }

    .rbag-digital-rating-item.users .img {
        right: -25px;
        top: -50px;
    }

    .rbag-digital-rating-item.sites .img {
        right: -25px;
        bottom: -30px;
    }

    .rbag-digital-rating-item .rbag-title {
        margin-bottom: 15px;
    }

    .rbag-facilities-block {
        background: url(https://realbig.agency/images/wp/facilities.png) no-repeat center;
        background-size: cover;
    }

    .rbag-footer {
        background: #F5F6FA;
        padding: 120px 0;
    }

    .rbag-footer .rbag-social-links a {
        background: url("https://realbig.agency/images/wp/social_back_footer.svg") no-repeat;
        width: 56px;
        height: 56px;
    }

    .rbag-footer-image img {
        max-width: 600px;
        flex: none;
    }


    /*-- END ALL --*/

    /*-- ADAPTIVE --*/

    @media (min-width: 992px) {
        .rbag-tablet-whole-width {
            width: 100%;
        }

        .rbag-tablet-half-width {
            width: 50%;
        }

        .rbag-tablet-three-width {
            width: 33.333%;
        }

        .rbag-remove-top-tablet {
            margin-top: -100px;
        }
    }

    @media (min-width: 1201px) {
        .rbag-right-padding-mobile {
            padding-right: 125px;
        }
    }

    @media (min-width: 1601px) {
        .rbag-desctop-width40 {
            width: 45%;
        }
    }

    @media (max-width: 1600px) {
        .rbag-title {
            font-size: 38px;
        }

        .rbag-top-main-info h1 {
            font-size: 48px;
        }

        .rbag-digital-rating-item .img img{
            width: 75%;
        }

        .rbag-digital-rating-item {
            padding: 60px 0;
        }
    }

    @media (max-width: 1200px) {
        .rbag-top-main-info {
            padding: 120px 0;
        }
        .rbag-section.rbag-with-spaces {
            padding: 100px 0;
        }

        .rbag-top-main-info h1 {
            font-size: 38px;
            line-height: 48px;
        }

        .rbag-title, .rbag-title.rbag-less-font {
            font-size: 28px;
        }

        .rbag-title.rbag-more-less-font {
            font-size: 20px;
        }

        .rbag-digital-rating-item {
            padding: 30px 0;
        }

        .rbag-digital-rating-item .img img{
            width: 55%;
        }

        .rbag-gray-text {
            font-size: 18px;
        }

        .rbag-digital-rating-item .rbag-title {
            margin: 0;
        }

        .rbag-digital-rating-block {
            padding-top: 70px;
        }

        .rbag-footer {
            padding: 100px 0;
        }
    }

    @media (max-width: 991px) {
        .rbag-mobile-full-width {
            width: 100%;
        }

        .rbag-social-links {
            margin-top: 60px;
        }

        .rbag-top-main-info {
            padding: 60px 0;
        }

        .rbag-section.rbag-with-spaces {
            padding: 60px 0;
        }

        .rbag-title, .rbag-gray-text {
            text-align: center;
        }

        .rbag-block-double-margin-bottom {
            margin-bottom: 30px;
        }

        .rbag-flex-first-mobile {
            order: -1;
        }

        .rbag-footer {
            padding: 30px 0;
        }

        .rbag-footer-image {
            max-width: 350px;
            margin: auto;
        }

        .rbag-footer .rbag-social-links {
            justify-content: center;
            margin-top: 30px;
        }
    }

    @media (max-width: 767px) {
        .rbag-top-main-info h1 {
            font-size: 28px;
            line-height: 32px;
        }

        .rbag-primary-btn, .rbag-social-links {
            margin-top: 30px;
        }

        .rbag-title, .rbag-title.rbag-less-font {
            font-size: 22px;
        }

        .rbag-gray-text, .rbag-gray-text.rbag-less-font {
            font-size: 14px;
        }

        .rbag-title.rbag-more-less-font {
            font-size: 18px;
        }
    }

</style>
<body>
    <div class="rbag-wrap">
        <div class="rbag-main">
            <div class="section rbag-top-main-info">
                <div class="rbag-container">
                    <div class="rbag-flex-wrap rbag-few-blocks rbag-with-wrap">
                        <div class="rbag-tablet-half-width">
                            <h1 class="rbag-right-padding-mobile">Размещение рекламы на сайтах RealBig.media</h1>
                            <a href="#" onclick="rbagPageButtonClicked();" data-href="https://realbig.agency/" class="rbag-primary-btn rbag-agency-redirect">Подробнее <span class="rbag-arrow"></span></a>
                            <div class="rbag-social-links">
                                <div><a href="https://t.me/RealBigSupBot" class="telegram"></a></div>
                                <!-- <div><a href="" class="facebook"></a></div>
                                <div><a href="" class="viber"></a></div> -->
                            </div>
                        </div>
                        <div class="rbag-tablet-half-width rbag-remove-top-tablet">
                            <img src="http://wpfolder/wordpress_test/wp-content/plugins/realbig-agency/assets/images/custom-page/info_img.png" alt="" srcset="" class="rbag-width-whole">
                        </div>
                    </div>
                </div>
            </div>
            <div class="rbag-section rbag-with-spaces rbag-hidden">
                <div class="rbag-container">
                    <div class="rbag-title rbag-block-double-margin-bottom">Наши цифры:</div>
                    <div class="rbag-flex-wrap rbag-few-blocks rbag-with-wrap rbag-digital-rating-block">
                        <div class="rbag-tablet-three-width rbag-mobile-full-width">
                            <div class="rbag-digital-rating-item rbag-center-all-flex rbag-flex-column views">
                                <div class="img"><img src="http://wpfolder/wordpress_test/wp-content/plugins/realbig-agency/assets/images/custom-page/views.svg" alt=""></div>
                                <div class="rbag-title rbag-less-font">3 000 000 000</div>
                                <div class="rbag-text-center rbag-gray-text">Показы рекламы за месяц</div>
                            </div>
                        </div>
                        <div class="rbag-tablet-three-width rbag-mobile-full-width">
                            <div class="rbag-digital-rating-item rbag-center-all-flex rbag-flex-column users">
                                <div class="img"><img src="http://wpfolder/wordpress_test/wp-content/plugins/realbig-agency/assets/images/custom-page/users.svg" alt=""></div>
                                <div class="rbag-title rbag-less-font">3 000</div>
                                <div class="rbag-text-center rbag-gray-text">Пользователей</div>
                            </div>
                        </div>
                        <div class="rbag-tablet-three-width rbag-mobile-full-width">
                            <div class="rbag-digital-rating-item rbag-center-all-flex rbag-flex-column sites">
                                <div class="img"><img src="http://wpfolder/wordpress_test/wp-content/plugins/realbig-agency/assets/images/custom-page/sites.svg" alt=""></div>
                                <div class="rbag-title rbag-less-font">30 000</div>
                                <div class="rbag-text-center rbag-gray-text">Сайтов</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="rbag-section rbag-with-spaces rbag-facilities-block">
                <div class="rbag-container">
                    <div class="rbag-flex-wrap rbag-few-blocks rbag-with-wrap rbag-center-flex">
                        <div class="rbag-desctop-width40 rbag-tablet-half-width">
                            <div class="rbag-title rbag-right-padding-mobile">
                                Мы можем подобрать вам сайты по нужным вам характеристикам: 
                            </div>
                        </div>
                        <div class="rbag-desctop-width40 rbag-tablet-half-width">
                            <div class="rbag-block-double-margin-bottom">
                                <div class="rbag-title rbag-more-less-font rbag-block-little-margin-bottom">Гео</div>
                                <div class="rbag-gray-text rbag-less-font">Мы постоянно работаем над расширением количества партнеров с которыми вы можете работать</div>
                            </div>
                            <div class="rbag-block-double-margin-bottom">
                                <div class="rbag-title rbag-more-less-font rbag-block-little-margin-bottom">Тематике</div>
                                <div class="rbag-gray-text rbag-less-font">У нас самая большая подборка ...</div>
                            </div>
                            <div class="">
                                <div class="rbag-title rbag-more-less-font rbag-block-little-margin-bottom">Демографии</div>
                                <div class="rbag-gray-text rbag-less-font">Исследовать закономерности изменения в населении можно только на примере множества лиц. Сбор информации возможен четырьмя способами</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="rbag-footer">
            <div class="rbag-container">
                <div class="rbag-flex-wrap rbag-few-blocks rbag-with-wrap">
                    <div class="rbag-tablet-half-width rbag-mobile-full-width">
                        <div class="rbag-title rbag-right-padding-mobile">Мы поможем найти вашу целевую аудиторию – пишите нам.</div>
                        <div class="rbag-social-links">
                            <div><a href="https://t.me/RealBigSupBot" class="telegram"></a></div>
                            <!-- <div><a href="" class="facebook"></a></div>
                            <div><a href="" class="viber"></a></div> -->
                        </div>
                    </div>
                    <div class="rbag-tablet-half-width rbag-mobile-full-width rbag-flex-end rbag-flex-first-mobile rbag-footer-image">
                        <img src="http://wpfolder/wordpress_test/wp-content/plugins/realbig-agency/assets/images/custom-page/footer_img.png" alt="" srcset="" class="rbag-width-whole">
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>