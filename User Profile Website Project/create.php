<?php
    $pageTitle = "Create Profile";
    $pageDescription = "This page lets the user create a profile";
    require_once './includes/Database.php';
    $success = null;

    // check for form submission
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        // get submitted data
        $userName = trim($_POST["user_name"]); // name of ID in form for user's username input
        // $_FILES holds the uploaded file info
        $imageFile = $_FILES["profile_image"]; // name of ID in form for user's profile image input
        // Validate and create the record
        if($db->create($userName, $imageFile)){
            $success = "Profile created"; // will echo in the form if successful
        }
    }
    require './templates/header.php'; // using require for header and footer because they're required more than once
?>
    <main>
        <div class="container col-xl-10 col-xxl-8 px-4 py-5">

            <section class="messageRow">
                <?php if ($success): ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo $success; ?>
                    </div>
                <?php endif; ?>
                <?php if ($db->error): ?>
                    <div class="alert alert-danger" role="alert">
                        Error: <?php echo $db->error; ?>
                    </div>
                <?php endif; ?>
            </section>

            <div class="row align-items-center g-lg-5 py-5">
                <div class="col-lg-7 text-center ">
                    <h1 class="display-4 fw-bold lh-1 mb-3">Create your Bookface profile</h1>
                    <p class="col-lg-10 fs-4 mx-auto">Simply enter a username for your profile and upload an image for your profile picture.</p>
                </div>

                <div class="col-md-10 mx-auto col-lg-5">
                    <form method="POST" enctype="multipart/form-data"  class="p-4 p-md-5 border rounded-3 bg-light">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="user_name" name="user_name" placeholder="Enter your username" required value="<?php echo htmlspecialchars($userName ?? '');?>">
                            <label for="user_name">Username</label>
                        </div>
                        <div class="mb-3">
                            <input type="file" class="form-control" id="profile_image" name="profile_image" required>
                            <label for="profile_image">Profile Image: Use JPG, PNG, GIF. Max 2MB.</label>
                        </div>
                        <button class="w-100 btn btn-lg btn-primary" type="submit">Sign up</button>
                        <hr class="my-4">
                        <small class="text-muted">By clicking Sign up, you agree to the terms of use.</small>
                    </form>
                </div>
            </div>

            <div class="modal modal-sheet position-static d-block bg-body-secondary p-4 py-md-5" tabindex="-1"
                 role="dialog" id="modalTour">
                <div class="modal-dialog">
                    <div class="modal-content rounded-4 shadow">
                        <div class="modal-body p-5"><h2 class="fw-bold mb-0">Why BookFace?</h2>
                            <ul class="d-grid gap-4 my-5 list-unstyled small">
                                <li class="d-flex gap-4">
                                    <div><h5 class="mb-0">Productivity</h5>
                                        No more doom-scrolling for hours
                                    </div>
                                </li>
                                <li class="d-flex gap-4">
                                    <div><h5 class="mb-0">Community</h5>
                                        No FOMO or need to cut out social media entirely
                                    </div>
                                </li>
                                <li class="d-flex gap-4">
                                    <div><h5 class="mb-0">Humanitarianism</h5>
                                        By signing up and ditching all other social media platforms,
                                        you'll benefit humanity.
                                    </div>
                                </li>
                            </ul>
                            <a href="index.php" class="btn btn-lg btn-primary mt-5 w-100" role="button">
                                See Profiles
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
<?php require './templates/footer.php'; ?>
