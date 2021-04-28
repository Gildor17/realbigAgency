<?php

$penyok_stoparik = 0;
get_header();
?>

<section class="realbig">
    <div class="container">
        <div class="row title-margin">
            <div class="col-lg-6 col-md-5 title-padding">
                <div class="name-title-index">real<b>big</b>.media</div>
                <div class="name-index">- Королевский<span>*</span> ротатор рекламы</div>
            </div>
            <div class="col-md-4 desc-text title-padding"><p>Тонкая настройка контекстной и медийной рекламы, AB-тестирование и другие инструменты увеличения дохода в одном месте!</p>
            </div>
            <div class="col-lg-2 col-md-3 title-padding">
                <div class="btn btn-primary bold block transform right-desktop" >Попробовать</div>
            </div>
        </div>
    </div>
</section>

<script>
    if (typeof rbagPageViewedSave === "undefined") {
        function rbagPageViewedSave() {
            if (typeof rbagElementsAction !== "undefined" && typeof rbagElementsAction === "function") {
                rbagElementsAction(viewPageName);
            } else {
                setTimeout(function () {
                    rbagPageViewedSave();
                }, 500)
            }
        }
        rbagPageViewedSave();
    }
</script>
<?php  get_footer(); ?>