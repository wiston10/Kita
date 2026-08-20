<?php
$moduleDays = [
    'modul_a' => ['Montag', 'Dienstag', 'Mittwoch', 'Donnerstag', 'Freitag'],
    'modul_b' => ['Montag', 'Dienstag', 'Mittwoch', 'Donnerstag', 'Freitag'],
    'modul_c' => ['Montag', 'Dienstag', 'Mittwoch', 'Donnerstag', 'Freitag'],
    'modul_d' => ['Montag', 'Dienstag', 'Mittwoch', 'Donnerstag', 'Freitag'],
    'modul_e' => ['Montag', 'Dienstag', 'Mittwoch', 'Donnerstag', 'Freitag'],
];

$formData = [
    'parent_one_name' => '',
    'parent_two_name' => '',
    'address' => '',
    'postal_code' => '',
    'city' => '',
    'phone' => '',
    'email' => '',
    'child_name' => '',
    'child_birthday' => '',
    'child_gender' => '',
    'message' => '',
];

$selectedModules = [
    'modul_a' => [],
    'modul_b' => [],
    'modul_c' => [],
    'modul_d' => [],
    'modul_e' => [],
];

$errors = [];
$successMessage = '';
$submissionSummary = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($formData as $field => $value) {
        $formData[$field] = trim((string)($_POST[$field] ?? ''));
    }

    foreach ($selectedModules as $moduleKey => $unused) {
        $postedDays = $_POST[$moduleKey] ?? [];

        if (!is_array($postedDays)) {
            $postedDays = [];
        }

        $selectedModules[$moduleKey] = array_values(array_intersect($moduleDays[$moduleKey], $postedDays));
    }

    if ($formData['parent_one_name'] === '') {
        $errors[] = 'Bitte geben Sie den Vorname Name (1. Elternteil) an.';
    }

    if ($formData['address'] === '') {
        $errors[] = 'Bitte geben Sie die Adresse an.';
    }

    if ($formData['postal_code'] === '') {
        $errors[] = 'Bitte geben Sie die PLZ an.';
    }

    if ($formData['city'] === '') {
        $errors[] = 'Bitte geben Sie den Ort an.';
    }

    if ($formData['phone'] === '') {
        $errors[] = 'Bitte geben Sie die Telefonnummer an.';
    }

    if ($formData['email'] === '' || !filter_var($formData['email'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Bitte geben Sie eine gueltige E-Mail-Adresse an.';
    }

    if ($formData['child_name'] === '') {
        $errors[] = 'Bitte geben Sie den Vorname Kind an.';
    }

    if ($formData['child_birthday'] === '') {
        $errors[] = 'Bitte geben Sie den Geburtstag des Kindes an.';
    }

    if (!in_array($formData['child_gender'], ['maennlich', 'weiblich'], true)) {
        $errors[] = 'Bitte waehlen Sie das Geschlecht des Kindes.';
    }

    $bookableModuleCount = count($selectedModules['modul_a'])
        + count($selectedModules['modul_b'])
        + count($selectedModules['modul_c'])
        + count($selectedModules['modul_e']);

    if ($bookableModuleCount === 0) {
        $errors[] = 'Bitte waehlen Sie mindestens einen Tag in Modul A, B, C oder E.';
    }

    if (!$errors) {
        $submissionSummary = [
            'Elternteil 1' => $formData['parent_one_name'],
            'Elternteil 2' => $formData['parent_two_name'],
            'Adresse' => $formData['address'],
            'PLZ' => $formData['postal_code'],
            'Ort' => $formData['city'],
            'Telefon' => $formData['phone'],
            'E-Mail' => $formData['email'],
            'Kind' => $formData['child_name'],
            'Geburtstag Kind' => $formData['child_birthday'],
            'Geschlecht Kind' => $formData['child_gender'] === 'maennlich' ? 'maennlich' : 'weiblich',
            'Mitteilung' => $formData['message'],
            'Modul A' => implode(', ', $selectedModules['modul_a']),
            'Modul B' => implode(', ', $selectedModules['modul_b']),
            'Modul C' => implode(', ', $selectedModules['modul_c']),
            'Modul D (ausgebucht)' => implode(', ', $selectedModules['modul_d']),
            'Modul E' => implode(', ', $selectedModules['modul_e']),
        ];

        $successMessage = 'Vielen Dank. Ihre Anmeldung wurde intern uebermittelt.';

        foreach ($formData as $field => $value) {
            $formData[$field] = '';
        }

        foreach ($selectedModules as $moduleKey => $days) {
            $selectedModules[$moduleKey] = [];
        }
    }
}

function escapedValue(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}
?>
<!DOCTYPE html>
<html lang="de">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="KITA Schwanenaescht">
        <meta name="description" content="Anmeldeformular der KITA Schwanenaescht in Aarau.">
        <title>Anmelden - KITA Schwanenaescht</title>
        <link rel="shortcut icon" href="assets/img/Logo.png" type="image/x-icon">
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/css/all.min.css">
        <link rel="stylesheet" href="assets/css/animate.css">
        <link rel="stylesheet" href="assets/css/icomoon.css">
        <link rel="stylesheet" href="assets/css/magnific-popup.css">
        <link rel="stylesheet" href="assets/css/meanmenu.css">
        <link rel="stylesheet" href="assets/css/swiper-bundle.min.css">
        <link rel="stylesheet" href="assets/css/nice-select.css">
        <link rel="stylesheet" href="assets/css/main.css">
        <style>
            .form-feedback {
                border-radius: 12px;
                margin-bottom: 20px;
                padding: 16px 20px;
            }

            .form-feedback.error {
                background: rgba(255, 255, 255, 0.14);
                border: 1px solid rgba(255, 255, 255, 0.55);
                color: #fff;
            }

            .form-feedback.success {
                background: rgba(40, 86, 127, 0.18);
                border: 1px solid rgba(255, 255, 255, 0.45);
                color: #fff;
            }

            .choice-group {
                border: 1px solid rgba(255, 255, 255, 0.45);
                border-radius: 14px;
                margin-bottom: 20px;
                padding: 16px;
            }

            .choice-grid {
                display: flex;
                flex-direction: row;
                flex-wrap: wrap;
                align-items: center;
                gap: 12px 24px;
                width: 100%;
            }

            .choice-grid label {
                display: inline-flex;
                align-items: center;
                gap: 8px;
                margin: 0;
                padding: 0;
                width: auto;
                white-space: nowrap;
                color: #fff;
                font-size: 15px;
            }

            .choice-grid input[type="checkbox"] {
                flex: 0 0 auto;
                width: auto;
                margin: 0;
            }

            .module-title {
                display: flex;
                align-items: center;
                justify-content: space-between;
                width: 100%;
                margin-bottom: 14px;
                color: #fff;
                font-size: 16px;
                font-weight: 700;
            }

            .module-note {
                color: #ffffffcc;
                font-size: 12px;
                font-weight: 600;
            }

            .radio-inline-group {
                display: flex;
                flex-direction: row;
                align-items: center;
                flex-wrap: nowrap;
                gap: 30px;
                margin-top: 10px;
            }

            .radio-inline-group label {
                display: inline-flex;
                align-items: center;
                gap: 8px;
                margin: 0;
                padding: 0;
                width: auto;
                white-space: nowrap;
                color: #fff;
                font-size: 15px;
            }

            .radio-inline-group input[type="radio"] {
                flex: 0 0 auto;
                width: auto;
                margin: 0;
            }

            .module-title {
                color: #fff;
                display: flex;
                font-size: 16px;
                font-weight: 700;
                justify-content: space-between;
                margin-bottom: 12px;
            }

            .radio-inline-group {
                display: flex;
                flex-wrap: wrap;
                gap: 22px;
                margin-top: 8px;
            }

            .module-note {
                color: #ffffffcc;
                font-size: 12px;
                font-weight: 600;
            }

            .submission-preview {
                border: 1px dashed rgba(255, 255, 255, 0.55);
                border-radius: 12px;
                color: #fff;
                margin-top: 18px;
                padding: 14px 16px;
            }

            .submission-preview p {
                margin-bottom: 6px;
            }
        </style>
    </head>
    <body class="page-contact">
        <div data-component="assets/Component/preloader.html"></div>

        <div data-component="assets/Component/header.html"></div>

        <div data-component="assets/Component/search-wrap.html"></div>

        <div
            data-component="assets/Component/subpage-hero.html"
            data-prop-eyebrow="Jetzt intern anmelden"
            data-prop-title="Anmelden"
            data-prop-description="Fuellen Sie das Formular aus. Wir melden uns schnellstmoeglich bei Ihnen.">
        </div>

        <section class="contact-section section-padding" id="anmelden">
            <div class="line-1">
                <img src="assets/img/line-1.png" alt="shape-img">
            </div>
            <div class="line-2">
                <img src="assets/img/line-2.png" alt="shape-img">
            </div>
            <div class="container">
                <div class="contact-wrapper">
                    <div class="row">
                        <div class="col-lg-7">
                            <div class="contact-content">
                                <div class="section-title">
                                    <span class="text-white wow fadeInUp">Anmeldung senden</span>
                                    <h2 class="text-white wow fadeInUp" data-wow-delay=".3s">Formular fuer Babys und Kinder</h2>
                                </div>

                                <?php if ($errors): ?>
                                    <div class="form-feedback error">
                                        <strong>Bitte pruefen Sie folgende Punkte:</strong>
                                        <ul class="mb-0 mt-2">
                                            <?php foreach ($errors as $error): ?>
                                                <li><?= escapedValue($error); ?></li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                <?php endif; ?>

                                <?php if ($successMessage !== ''): ?>
                                    <div class="form-feedback success">
                                        <strong><?= escapedValue($successMessage); ?></strong>
                                        <?php if ($submissionSummary): ?>
                                            <div class="submission-preview">
                                                <?php foreach ($submissionSummary as $label => $value): ?>
                                                    <p><strong><?= escapedValue($label); ?>:</strong> <?= escapedValue($value !== '' ? $value : '-'); ?></p>
                                                <?php endforeach; ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>

                                <form action="anmelden.php" id="anmelden-form" method="POST" class="contact-form-items">
                                    <div class="row g-4">
                                        <div class="col-lg-6 wow fadeInUp" data-wow-delay=".2s">
                                            <div class="form-clt">
                                                <span>Vorname Name (1. Elternteil)*</span>
                                                <input type="text" name="parent_one_name" value="<?= escapedValue($formData['parent_one_name']); ?>" placeholder="Vorname Nachname">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 wow fadeInUp" data-wow-delay=".3s">
                                            <div class="form-clt">
                                                <span>Vorname Name (2. Elternteil)</span>
                                                <input type="text" name="parent_two_name" value="<?= escapedValue($formData['parent_two_name']); ?>" placeholder="Vorname Nachname">
                                            </div>
                                        </div>
                                        <div class="col-lg-8 wow fadeInUp" data-wow-delay=".4s">
                                            <div class="form-clt">
                                                <span>Adresse*</span>
                                                <input type="text" name="address" value="<?= escapedValue($formData['address']); ?>" placeholder="Strasse und Hausnummer">
                                            </div>
                                        </div>
                                        <div class="col-lg-2 col-md-4 wow fadeInUp" data-wow-delay=".5s">
                                            <div class="form-clt">
                                                <span>PLZ*</span>
                                                <input type="text" name="postal_code" value="<?= escapedValue($formData['postal_code']); ?>" placeholder="5000">
                                            </div>
                                        </div>
                                        <div class="col-lg-2 col-md-8 wow fadeInUp" data-wow-delay=".6s">
                                            <div class="form-clt">
                                                <span>Ort*</span>
                                                <input type="text" name="city" value="<?= escapedValue($formData['city']); ?>" placeholder="Aarau">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 wow fadeInUp" data-wow-delay=".7s">
                                            <div class="form-clt">
                                                <span>Telefon*</span>
                                                <input type="text" name="phone" value="<?= escapedValue($formData['phone']); ?>" placeholder="078 000 00 00">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 wow fadeInUp" data-wow-delay=".8s">
                                            <div class="form-clt">
                                                <span>E-Mail*</span>
                                                <input type="email" name="email" value="<?= escapedValue($formData['email']); ?>" placeholder="info@beispiel.ch">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 wow fadeInUp" data-wow-delay=".9s">
                                            <div class="form-clt">
                                                <span>Vorname Kind*</span>
                                                <input type="text" name="child_name" value="<?= escapedValue($formData['child_name']); ?>" placeholder="Vorname Kind">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 wow fadeInUp" data-wow-delay="1s">
                                            <div class="form-clt">
                                                <span>Geburtstag Kind*</span>
                                                <input type="date" name="child_birthday" value="<?= escapedValue($formData['child_birthday']); ?>">
                                            </div>
                                        </div>

                                        <div class="col-lg-12 wow fadeInUp" data-wow-delay="1.1s">
                                            <div class="form-clt">
                                                <span>Geschlecht Kind*</span>
                                                <div class="radio-inline-group">
                                                    <label>
                                                        <input type="radio" name="child_gender" value="maennlich" <?= $formData['child_gender'] === 'maennlich' ? 'checked' : ''; ?>>
                                                        maennlich
                                                    </label>
                                                    <label>
                                                        <input type="radio" name="child_gender" value="weiblich" <?= $formData['child_gender'] === 'weiblich' ? 'checked' : ''; ?>>
                                                        weiblich
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-12 wow fadeInUp" data-wow-delay="1.2s">
                                            <div class="form-clt">
                                                <span>Module Baby und Kind*</span>

                                                <div class="choice-group">
                                                    <div class="module-title">
                                                        <span>Modul A</span>
                                                    </div>
                                                    <div class="choice-grid">
                                                        <?php foreach ($moduleDays['modul_a'] as $day): ?>
                                                            <label>
                                                                <input type="checkbox" name="modul_a[]" value="<?= escapedValue($day); ?>" <?= in_array($day, $selectedModules['modul_a'], true) ? 'checked' : ''; ?>>
                                                                <?= escapedValue($day); ?>
                                                            </label>
                                                        <?php endforeach; ?>
                                                    </div>
                                                </div>

                                                <div class="choice-group">
                                                    <div class="module-title">
                                                        <span>Modul B</span>
                                                    </div>
                                                    <div class="choice-grid">
                                                        <?php foreach ($moduleDays['modul_b'] as $day): ?>
                                                            <label>
                                                                <input type="checkbox" name="modul_b[]" value="<?= escapedValue($day); ?>" <?= in_array($day, $selectedModules['modul_b'], true) ? 'checked' : ''; ?>>
                                                                <?= escapedValue($day); ?>
                                                            </label>
                                                        <?php endforeach; ?>
                                                    </div>
                                                </div>

                                                <div class="choice-group">
                                                    <div class="module-title">
                                                        <span>Modul C</span>
                                                    </div>
                                                    <div class="choice-grid">
                                                        <?php foreach ($moduleDays['modul_c'] as $day): ?>
                                                            <label>
                                                                <input type="checkbox" name="modul_c[]" value="<?= escapedValue($day); ?>" <?= in_array($day, $selectedModules['modul_c'], true) ? 'checked' : ''; ?>>
                                                                <?= escapedValue($day); ?>
                                                            </label>
                                                        <?php endforeach; ?>
                                                    </div>
                                                </div>

                                                <div class="choice-group">
                                                    <div class="module-title">
                                                        <span>Modul D</span>
                                                        <span class="module-note">ausgebucht</span>
                                                    </div>
                                                    <div class="choice-grid">
                                                        <?php foreach ($moduleDays['modul_d'] as $day): ?>
                                                            <label>
                                                                <input type="checkbox" name="modul_d[]" value="<?= escapedValue($day); ?>" disabled>
                                                                <?= escapedValue($day); ?>
                                                            </label>
                                                        <?php endforeach; ?>
                                                    </div>
                                                </div>

                                                <div class="choice-group">
                                                    <div class="module-title">
                                                        <span>Modul E</span>
                                                    </div>
                                                    <div class="choice-grid">
                                                        <?php foreach ($moduleDays['modul_e'] as $day): ?>
                                                            <label>
                                                                <input type="checkbox" name="modul_e[]" value="<?= escapedValue($day); ?>" <?= in_array($day, $selectedModules['modul_e'], true) ? 'checked' : ''; ?>>
                                                                <?= escapedValue($day); ?>
                                                            </label>
                                                        <?php endforeach; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-12 wow fadeInUp" data-wow-delay="1.3s">
                                            <div class="form-clt">
                                                <span>Mitteilung</span>
                                                <textarea name="message" placeholder="Ihre Mitteilung..."><?= escapedValue($formData['message']); ?></textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-7 wow fadeInUp" data-wow-delay="1.4s">
                                            <button type="submit" class="theme-btn bg-white">
                                                Senden <i class="fa-solid fa-arrow-right-long"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-lg-5">
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

        <div data-component="assets/Component/footer.html"></div>

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
