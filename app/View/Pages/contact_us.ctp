<?php $this->Combinator->add_libs('css', $this->Less->css('contact_us')) ?>

<div id="contactUs" class="container">
    <div class="row">
        <div class="content col-md-10 col-md-offset-1 col-lg-8 col-lg-offset-2">
            <div class="row">

                <div class="col-sm-4">
                    <h3><?= __('LC_CONTACTUS_HEADLINE') ?></h3>
                    <hr>
                    <h4>
                        <strong>Eliza Kruczkowska</strong>
                        <small>Director of Communications</small>
                    </h4>
                    <address>
                        <p>
                            <strong><?= __('LC_CONTACTUS_PHONE') ?></strong>
                            +48 508 295 565
                        </p>

                        <p>
                            <strong>email:</strong>
                            <a href="mailto:eliza.kruczkowska@epf.org.pl">eliza.kruczkowska@epf.org.pl</a>
                        </p>
                    </address>

                    <h4>
                        <strong>Fundacja ePaństwo</strong>
                    </h4>
                    <address>
                        <p>Zgorzała, ul. Pliszki 2B/1</p>

                        <p>05-500 Mysiadło</p>

                        <p>KRS: 0000359730</p>

                        <p>
                            <strong>email:</strong>
                            <a href="mailto:biuro@epf.org.pl">biuro@epf.org.pl</a>
                        </p>
                    </address>
                </div>

                <div class="col-sm-8 contact-form">
                    <form id="contact" method="post" class="form" role="form">
                        <div class="row">
                            <div class="col-xs-6 col-md-6 form-group">
                                <input class="form-control" id="name" name="name" placeholder="<?= __('LC_CONTACTUS_PLACEHOLDER_NAME') ?>" type="text"
                                       required autofocus/>
                            </div>
                            <div class="col-xs-6 col-md-6 form-group">
                                <input class="form-control" id="email" name="email" placeholder="<?= __('LC_CONTACTUS_PLACEHOLDER_EMAIL') ?>" type="email"
                                       required/>
                            </div>
                        </div>

                        <textarea class="form-control" id="message" name="message" rows="8"></textarea>

                        <div class="row">
                            <div class="col-xs-12 col-md-12 form-group">
                                <button class="btn btn-primary pull-right" type="submit"><?= __('LC_CONTACTUS_SEND') ?></button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>