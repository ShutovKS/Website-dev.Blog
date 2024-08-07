<?php
/**
 * @var View $view
 * @var array $data
 * @var string $title
 */

use App\Kernel\Services\View\View;
use App\Models\User;

/** @var User $user */
$user = $data['user'];

$socials = [
    'website' => $user->socialWebsite,
    'github' => $user->socialGithub,
    'vk' => $user->socialVk,
    'telegram' => $user->socialTelegram,
];

$socialsSample = $data['socials_in_profile'];
$errors = $data['errors'];
$view->component('start', ['title' => $title]);
$view->component('header', $data);

?>

<main class="container">
    <div class="main-body">

        <div class="row gutters-sm">
            <div class="col-md-4 mb-3">

                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-column align-items-center text-center">
                            <img src="<?php echo $user->linkToPhoto; ?>" alt="Admin" class="rounded-circle" width="150"
                                 height="150">

                            <div class="mt-3">

                                <form method="post" action="/user/settings/updatePhoto" enctype="multipart/form-data">
                                    <input name="user_id" type="hidden" value="<?php echo $user->id; ?>">

                                    <div class="row mb-3">
                                        <label for="link_to_photo" class="col-sm-2 col-form-label">Url</label>
                                        <div class="col-sm-10">
                                            <input type="url" class="form-control" id="link_to_photo"
                                                   name="link_to_photo" placeholder="Url on photo"
                                                   value="<?php echo $user->linkToPhoto; ?>">
                                        </div>
                                    </div>

                                    <input type="submit" class="btn btn-primary px-4 mt-2" value="Change Photo">
                                </form>

                            </div>

                            <?php if (isset($errors['updatePhoto'])): ?>
                                <div class="text-danger">
                                    <ul>
                                        <?php foreach ($errors['updatePhoto'] as $error): ?>
                                            <li><?php echo $error; ?></li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            <?php endif; ?>

                        </div>
                    </div>
                </div>

                <form class="card mt-3" method="post" action="/user/settings/updateSocials" name="socials-form">
                    <input name="user_id" type="hidden" value="<?php echo $user->id; ?>">

                    <h5 class="card-header">Socials</h5>

                    <div class="list-group list-group-flush">

                        <?php foreach ($socials as $key => $social_link): ?>
                            <?php if (!isset($socialsSample[$key])) {
                                continue;
                            } ?>

                            <?php $socialSample = $socialsSample[$key]; ?>

                            <li class="list-group-item">
                                <div class="row align-items-center">
                                    <form class="card mt-3">
                                        <div class="col-md-auto form-control-color text-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                 viewBox="<?php echo $socialSample['viewBox']; ?>"
                                                 fill="<?php echo $socialSample['svg_fill'] ?>"
                                                 stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                 stroke-linejoin="round">

                                                <?php
                                                if (isset($socialSample['svg_elements'])):
                                                    foreach ($socialSample['svg_elements'] as $svg_element):
                                                        echo $svg_element;
                                                    endforeach;
                                                endif;
                                                ?>

                                                <path d="<?php echo $socialSample['svg_path']; ?>"></path>
                                            </svg>
                                        </div>

                                        <div class="col-md-3">
                                            <h6 class="form-control-plaintext"><?php echo $socialSample['name']; ?></h6>
                                        </div>

                                        <div class="col-md-auto">
                                            <label for="city-name">
                                                <input type="text" class="form-control" id="city-name"
                                                       placeholder="City" autocomplete="on" name="<?php echo $key; ?>"
                                                       value="<?php echo $social_link; ?>">
                                            </label>
                                        </div>
                                </div>
                            </li>

                        <?php endforeach; ?>

                        <div class="m-2 text-center">
                            <div class="">
                                <input type="submit" class="btn btn-primary px-4" value="Save Changes">
                            </div>
                        </div>

                    </div>

                    <?php if (isset($errors['updateSocials'])): ?>
                        <div class="text-danger">
                            <ul>
                                <?php foreach ($errors['updateSocials'] as $error): ?>
                                    <li><?php echo $error; ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                </form>
            </div>


            <div class="col-lg-8">

                <form class="card mb-3" method="post" action="/user/settings/updateProfile" name="profile-form">
                    <input name="user_id" type="hidden" value="<?php echo $user->id; ?>">

                    <h5 class="card-header">Profile</h5>

                    <div class="card-body">
                        <div class="row mb-3">
                            <label for="username" class="col-sm-2 col-form-label">Username</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="username" name="username"
                                       placeholder="Username"
                                       autocomplete="on" disabled="" value="<?php echo $user->username; ?>">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="full_name" class="col-sm-2 col-form-label">Full Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="full_name" name="full_name"
                                       placeholder="Full Name"
                                       autocomplete="on" value="<?php echo $user->fullName; ?>">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control" id="email" name="email" placeholder="Email"
                                       autocomplete="on" disabled="" value="<?php echo $user->email; ?>">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="phone" class="col-sm-2 col-form-label">Phone</label>
                            <div class="col-sm-10">
                                <input type="tel" class="form-control" id="phone" name="phone" placeholder="Phone"
                                       autocomplete="on" value="<?php echo $user->phone; ?>">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="country-name" class="col-sm-2 col-form-label">Country</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="country-name" name="country"
                                       placeholder="Country"
                                       autocomplete="on" value="<?php echo $user->locationCountry; ?>">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="city-name" class="col-sm-2 col-form-label">City</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="city-name" name="city" placeholder="City"
                                       autocomplete="on" value="<?php echo $user->locationCity; ?>">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="job" class="col-sm-2 col-form-label">Job</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="job" name="job" placeholder="Job"
                                       autocomplete="on" value="<?php echo $user->job; ?>">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-2"></div>
                            <div class="col-sm-10 text-secondary">
                                <input type="submit" class="btn btn-primary px-4" value="Save Changes">
                            </div>
                        </div>
                    </div>

                    <?php if (isset($errors['updateProfile'])): ?>
                        <div class="row">
                            <div class="text-danger">
                                <ul>
                                    <?php foreach ($errors['updateProfile'] as $error): ?>
                                        <li><?php echo $error; ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>
                    <?php endif; ?>

                </form>

                <div class="row">

                    <form method="post" action="/user/settings/updatePassword" name="password-form" class="col-md-7">
                        <input name="user_id" type="hidden" value="<?php echo $user->id; ?>">

                        <div class="col-md-12 card">

                            <h5 class="card-header">Change Password</h5>

                            <div class="card-body">
                                <div class="row mb-3">
                                    <label for="old-password" class="col-sm-4 col-form-label">Old Password</label>
                                    <div class="col-sm-8">
                                        <input type="password" class="form-control" id="old-password"
                                               placeholder="Old Password" name="old_password"
                                               autocomplete="off">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="new-password" class="col-sm-4 col-form-label">New Password</label>
                                    <div class="col-sm-8">
                                        <input type="password" class="form-control" id="new-password"
                                               placeholder="New Password" name="new_password"
                                               autocomplete="off">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="confirm-password" class="col-sm-4 col-form-label">Confirm
                                        Password</label>
                                    <div class="col-sm-8">
                                        <input type="password" class="form-control" id="confirm-password"
                                               placeholder="Confirm Password" name="confirm_password"
                                               autocomplete="off">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-4"></div>
                                    <div class="col-sm-8 text-secondary">
                                        <input type="submit" class="btn btn-primary px-4" value="Save Changes">
                                    </div>
                                </div>

                            </div>

                            <?php if (isset($errors['updatePassword'])): ?>

                                <div class="row">
                                    <div class="text-danger">
                                        <ul>
                                            <?php foreach ($errors['updatePassword'] as $error): ?>
                                                <li><?php echo $error; ?></li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                </div>

                            <?php endif; ?>

                        </div>

                    </form>

                    <div class="col-md-5">

                        <form method="post" action="/user/settings/deleteAccount" name="delete-form"
                              class="col-md-12 card">
                            <input name="user_id" type="hidden" value="<?php echo $user->id; ?>">

                            <h5 class="card-header">Delete Account</h5>

                            <div class="card-body">
                                <div class="row mb-3">
                                    <label for="password" class="col-sm-4 col-form-label">Password</label>
                                    <div class="col-sm-8">
                                        <input type="password" class="form-control" id="password"
                                               placeholder="Password" name="password"
                                               autocomplete="off">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-4"></div>
                                    <div class="col-sm-8 text-secondary">
                                        <input type="submit" class="btn btn-danger px-4" value="Delete Account">
                                    </div>
                                </div>

                            </div>

                            <?php if (isset($errors['deleteAccount'])): ?>

                                <div class="row">
                                    <div class="text-danger">
                                        <ul>
                                            <?php foreach ($errors['deleteAccount'] as $error): ?>
                                                <li><?php echo $error; ?></li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                </div>

                            <?php endif; ?>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>

</main>

<?php $view->component('footer'); ?>

<?php $view->component('end'); ?>
