<?= $this->include('layout/header'); ?>

<?= $this->include('layout/sidebar'); ?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><?= $title; ?></h1>
                </div><div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url('/'); ?>">Home</a></li>
                        <li class="breadcrumb-item active"><?= $title; ?></li>
                    </ol>
                </div></div></div></div>
    <section class="content">
        <div class="container-fluid">
            <?= $this->renderSection('content'); ?>
        </div></section>
    </div>
<?= $this->include('layout/footer'); ?>

