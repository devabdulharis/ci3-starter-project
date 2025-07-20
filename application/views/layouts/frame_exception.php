<!DOCTYPE html>
<html lang="en">

<head>
    <title><?= $this->renderSection('page_title') ?></title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description"
        content="Berry is trending dashboard template made using Bootstrap 5 design framework. Berry is available in Bootstrap, React, CodeIgniter, Angular,  and .net Technologies.">
    <meta name="keywords"
        content="Bootstrap admin template, Dashboard UI Kit, Dashboard Template, Backend Panel, react dashboard, angular dashboard">
    <meta name="author" content="codedthemes">

    <link rel="icon" href="<?=base_url('assets/');?>images/favicon.svg" type="image/x-icon">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;700&display=swap"
        id="main-font-link">

    <link rel="stylesheet" href="<?=base_url('assets/');?>fonts/tabler-icons.min.css">

    <link rel="stylesheet" href="<?=base_url('assets/');?>fonts/feather.css">

    <link rel="stylesheet" href="<?=base_url('assets/');?>fonts/fontawesome.css">

    <link rel="stylesheet" href="<?=base_url('assets/');?>fonts/material.css">

    <link rel="stylesheet" href="<?=base_url('assets/');?>css/style.css" id="main-style-link">
    <link rel="stylesheet" href="<?=base_url('assets/');?>css/style-preset.css">
</head>


<body>

    <div class="loader-bg">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div>


    <div class="maintenance-block">
        <div class="container">
            <?= $this->renderSection('content') ?>
        </div>
    </div>


    <script src="<?=base_url('assets/');?>js/plugins/popper.min.js"></script>
    <script src="<?=base_url('assets/');?>js/plugins/simplebar.min.js"></script>
    <script src="<?=base_url('assets/');?>js/plugins/bootstrap.min.js"></script>
    <script src="<?=base_url('assets/');?>js/fonts/custom-font.js"></script>
    <script src="<?=base_url('assets/');?>js/pcoded.js"></script>
    <script src="<?=base_url('assets/');?>js/plugins/feather.min.js"></script>
    <script>
    layout_change('light');
    </script>
    <script>
    font_change("Manrope");
    </script>
    <script>
    change_box_container('false');
    </script>
    <script>
    layout_caption_change('true');
    </script>
    <script>
    layout_rtl_change('false');
    </script>
    <script>
    preset_change("preset-7");
    </script>
</body>

</html>