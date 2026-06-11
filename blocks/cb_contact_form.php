<section class="contact_form py-5 bg-dark text-white" id="contact">
    <div class="container-xl">
        <h2 class="mb-4">Speak to an expert</h2>
        <div class="row">
            <div class="col-md-6">
                <ul class="fa-ul contact_list">
                    <li><span class="fa-li"><i class="fa-solid fa-square"></i></span> <?=do_shortcode('[contact_phone]')?></li>
                    <li><span class="fa-li"><i class="fa-solid fa-square"></i></span> <?=do_shortcode('[contact_email]')?></li>
                </ul>
            </div>
            <div class="col-md-6">
                <div class="social_icons"><?=do_shortcode('[social_icons]')?></div>
            </div>
        </div>
        <?=do_shortcode('[gravityform id="1" title="false"]')?>
    </div>
</section>