<?php
    // page title and description for home page
    $pageTitle = "View Profiles";
    $pageDesc = "this page will allow users to view created profiles";
    require_once "./includes/Database.php";
    // call on the read method,
    $profiles = $db->read();
    // check if theres a read error
    if($profiles == false){
        $readError = "<p>No profiles found.</p>";
    }
    require 'templates/header.php';
?>
    <main>
        <section class="home-hero">
        <div class="container py-5 mb-4 bg-light rounded-3 text-center">
            <div class="p-5 mb-4 lc-block">
                <div class="lc-block">
                    <div editable="rich">
                        <h2 class="fw-bolder display-3">Welcome to Bookface</h2>
                    </div>
                </div>
                <div class="lc-block col-md-8 mx-auto">
                    <div editable="rich">
                        <p class="lead">Bookface is an innovative social media platform which only allows users to create
                            a username and profile image. There is no posting, stories, etc. Many
                            people are aware of the negative effects of social media but also have a fear of missing out
                            on it. With Bookface, the only thing you'll be missing out on is the detrimental effects of
                            social media whilst still being able to have a presence online.
                        </p>
                    </div>
                </div>
                <div class="lc-block">
                    <a class="btn btn-primary" href="create.php" role="button">Click here, to create a profile</a>
                </div>
            </div>
        </div>
        </section>
        <section class="message-row ">
            <div class="container">
            <?php if(isset($readError)): ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $readError?>
            </div>
            <?php endif; ?>
            </div>
        </section>
        <section class="profilesRow">
            <div class="container">
            <?php if ($profiles && count($profiles) > 0): ?>
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-5 g-4">
                    <?php foreach ($profiles as $profile): ?>
                        <div class="col">
                            <div class="card h-100">
                                <img src="<?php echo htmlspecialchars($profile['image_path']); ?>"
                                     alt="<?php echo htmlspecialchars($profile['user_name']); ?>"
                                     class="card-img-top" style="height:200px;object-fit:cover;">
                                <div class="card-body">
                                    <p class="card-text mb-0"><?php echo htmlspecialchars($profile['user_name']); ?></p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="alert alert-info">No profiles found. Be the first to create one.</div>
            <?php endif; ?>
            </div>
        </section>
    </main>
<?php require './templates/footer.php'; ?>
