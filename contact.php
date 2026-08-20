<?php
$formData = [
    'name' => '',
    'email' => '',
    'message' => '',
];

$errors = [];
$successMessage = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $formData['name'] = trim((string)($_POST['name'] ?? ''));
    $formData['email'] = trim((string)($_POST['email'] ?? ''));
    $formData['message'] = trim((string)($_POST['message'] ?? ''));

    if ($formData['name'] === '') {
        $errors[] = 'Bitte geben Sie Ihren Namen an.';
    }

    if ($formData['email'] === '' || !filter_var($formData['email'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Bitte geben Sie eine gueltige E-Mail-Adresse an.';
    }

    if ($formData['message'] === '') {
        $errors[] = 'Bitte geben Sie Ihre Nachricht an.';
    }

    if (!$errors) {
        // Platzhalter fuer spaetere Mail- oder Datenbankintegration.
        $successMessage = 'Vielen Dank. Ihre Nachricht wurde intern uebermittelt.';
        $formData = ['name' => '', 'email' => '', 'message' => ''];
    }
}

function e(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}
?>
<!DOCTYPE html>
<html lang="en">
    <!--<< Header Area >>-->
    <head>
        <!-- ========== Meta Tags ========== -->
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="KITA Schwanenäscht">
        <meta name="description" content="Kontakt und Anfrageformular der KITA Schwanenäscht in Aarau.">
        <!-- ======== Page title ============ -->
        <title>Kontakt – KITA Schwanenäscht</title>
        <!--<< Favcion >>-->
        <link rel="shortcut icon" href="assets/img/Logo.png" type="image/x-icon">
        <!--<< Bootstrap min.css >>-->
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
        <!--<< All Min Css >>-->
        <link rel="stylesheet" href="assets/css/all.min.css">
        <!--<< Animate.css >>-->
        <link rel="stylesheet" href="assets/css/animate.css">
        <!--<< Icomoon.css >>-->
        <link rel="stylesheet" href="assets/css/icomoon.css">
        <!--<< Magnific Popup.css >>-->
        <link rel="stylesheet" href="assets/css/magnific-popup.css">
        <!--<< MeanMenu.css >>-->
        <link rel="stylesheet" href="assets/css/meanmenu.css">
        <!--<< Swiper Bundle.css >>-->
        <link rel="stylesheet" href="assets/css/swiper-bundle.min.css">
        <!--<< Nice Select.css >>-->
        <link rel="stylesheet" href="assets/css/nice-select.css">
        <!--<< Main.css >>-->
        <link rel="stylesheet" href="assets/css/main.css">
    </head>
    <body class="page-contact">

        <div data-component="assets/Component/preloader.html"></div>

        <div data-component="assets/Component/header.html"></div>

        


        <div
            data-component="assets/Component/subpage-hero.html"
            data-prop-eyebrow="Wir sind für Sie da"
            data-prop-title="Kontakt"
            data-prop-description="Schreiben Sie uns oder rufen Sie an. Wir beantworten gerne Ihre Fragen.">
        </div>

        <!-- Contact Section Start -->
        <section class="contact-section section-padding" id="kontakt">
            <div class="line-1">
                <img src="assets/img/line-1.png" alt="shape-img">
            </div>
            <div class="line-2">
                <img src="assets/img/line-2.png" alt="shape-img">
            </div>
            <div class="container">
                <div class="contact-wrapper">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="contact-content">
                                <div class="section-title">
                                    <span class="text-white wow fadeInUp">Kontakt aufnehmen</span>
                                    <h2 class="text-white wow fadeInUp" data-wow-delay=".3s">Wie können wir Ihnen helfen?</h2>
                                </div>

                                <?php if ($errors): ?>
                                    <div class="text-white mb-3" role="alert" aria-live="polite">
                                        <strong>Bitte pruefen Sie folgende Punkte:</strong>
                                        <ul class="mb-0 mt-2">
                                            <?php foreach ($errors as $error): ?>
                                                <li><?= e($error); ?></li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                <?php endif; ?>

                                <?php if ($successMessage !== ''): ?>
                                    <div class="text-white mb-3" role="status" aria-live="polite">
                                        <strong><?= e($successMessage); ?></strong>
                                    </div>
                                <?php endif; ?>

                                <form action="contact.php" id="contact-form" method="POST" class="contact-form-items">
                                    <div class="row g-4">
                                        <div class="col-lg-6 wow fadeInUp" data-wow-delay=".3s">
                                            <div class="form-clt">
                                                <span>Ihr Name*</span>
                                                <input type="text" name="name" id="name" value="<?= e($formData['name']); ?>" placeholder="Vorname Nachname">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 wow fadeInUp" data-wow-delay=".5s">
                                            <div class="form-clt">
                                                <span>Ihre E-Mail*</span>
                                                <input type="email" name="email" id="email" value="<?= e($formData['email']); ?>" placeholder="info@beispiel.ch">
                                            </div>
                                        </div>
                                        <div class="col-lg-12 wow fadeInUp" data-wow-delay=".7s">
                                            <div class="form-clt">
                                                <span>Nachricht*</span>
                                                <textarea name="message" id="message" placeholder="Ihre Nachricht..."><?= e($formData['message']); ?></textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-7 wow fadeInUp" data-wow-delay=".9s">
                                            <button type="submit" class="theme-btn bg-white">
                                                Anfrage senden <i class="fa-solid fa-arrow-right-long"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="contact-image wow fadeInUp" data-wow-delay=".4s">
                                <img src="assets/img/kita200.jpg" alt="contact-img">
                                <div class="cricle-shape">
                                    <img src="assets/img/circle-2.png" alt="shape-img">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!--<< Footer Section Start >>-->
        <div data-component="assets/Component/footer.html"></div>

        <!--<< All JS Plugins >>-->
        <script src="assets/js/jquery-3.7.1.min.js"></script>
        <script src="assets/js/viewport.jquery.js"></script>
        <script src="assets/js/bootstrap.bundle.min.js"></script>
        <script src="assets/js/jquery.nice-select.min.js"></script>
        <script src="assets/js/jquery.waypoints.js"></script>
        <script src="assets/js/jquery.counterup.min.js"></script>
        <script src="assets/js/swiper-bundle.min.js"></script>
        <script src="assets/js/jquery.meanmenu.min.js"></script>
        <script src="assets/js/jquery.magnific-popup.min.js"></script>
        <script src="assets/js/wow.min.js"></script>
        <script src="assets/js/main.js?v=20260603"></script>
    </body>
</html>
