
<!DOCTYPE html>
<html lang="en">
    <?php include "./includes/head.php"; ?>
    <body>
    <?php include "./includes/header.php"; ?>
    <div class="wrapper">
        <h1>List a new property</h1>
        <div>
            <h3>What type of property are we adding?</h3>
            <div class="flex m-auto w-fit gap-4">
                <a class="flex flex-col items-center justify-center  font-darkgrey" href="/homes/create.php">
                <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 256 256" height="200px" width="200px" xmlns="http://www.w3.org/2000/svg"><path d="M240,208H224V136l2.34,2.34A8,8,0,0,0,237.66,127L139.31,28.68a16,16,0,0,0-22.62,0L18.34,127a8,8,0,0,0,11.32,11.31L32,136v72H16a8,8,0,0,0,0,16H240a8,8,0,0,0,0-16ZM48,120l80-80,80,80v88H160V152a8,8,0,0,0-8-8H104a8,8,0,0,0-8,8v56H48Zm96,88H112V160h32Z"></path></svg>
                    <p>House</p>
                </a>
                <a class="flex flex-col items-center justify-center font-darkgrey" href="/apartments/create.php">
                    <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 256 256" height="200px" width="200px" xmlns="http://www.w3.org/2000/svg"><path d="M240,204h-4V76a12,12,0,0,0-12-12H188V40a12,12,0,0,0-12-12H80A12,12,0,0,0,68,40v60H32a12,12,0,0,0-12,12v92H16a12,12,0,0,0,0,24H240a12,12,0,0,0,0-24ZM44,124H80a12,12,0,0,0,12-12V52h72V76a12,12,0,0,0,12,12h36V204H148V176a4,4,0,0,0-4-4H112a4,4,0,0,0-4,4v28H44Zm64-48a12,12,0,0,1,12-12h16a12,12,0,0,1,0,24H120A12,12,0,0,1,108,76Zm0,36a12,12,0,0,1,12-12h16a12,12,0,0,1,0,24H120A12,12,0,0,1,108,112Zm52,0a12,12,0,0,1,12-12h16a12,12,0,0,1,0,24H172A12,12,0,0,1,160,112ZM96,148a12,12,0,0,1-12,12H68a12,12,0,0,1,0-24H84A12,12,0,0,1,96,148Zm12,0a12,12,0,0,1,12-12h16a12,12,0,0,1,0,24H120A12,12,0,0,1,108,148Zm52,0a12,12,0,0,1,12-12h16a12,12,0,0,1,0,24H172A12,12,0,0,1,160,148Z"></path></svg>
                    <p>Apartment</p>
                    </a>
                <a class="flex flex-col items-center justify-center font-darkgrey" href="/land/create.php">
                    <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 256 256" height="200px" width="200px" xmlns="http://www.w3.org/2000/svg"><path d="M196.55,64.09a74,74,0,0,0-137.1,0A69.71,69.71,0,0,0,18,127.8C17.9,164.91,49.13,197,86.19,198A70.32,70.32,0,0,0,122,189.16V232a6,6,0,0,0,12,0V189.16A70.1,70.1,0,0,0,168,198l1.77,0C206.87,197,238.1,164.9,238,127.8A69.71,69.71,0,0,0,196.55,64.09ZM169.5,186A57.88,57.88,0,0,1,134,175V131.71l44.68-22.34a6,6,0,1,0-5.36-10.74L134,118.29V88a6,6,0,0,0-12,0v54.29L82.68,122.63a6,6,0,0,0-5.36,10.74L122,155.71V175a58.09,58.09,0,0,1-35.5,11c-30.71-.77-56.58-27.4-56.5-58.14A57.78,57.78,0,0,1,66.37,74.19a6,6,0,0,0,3.39-3.51,62,62,0,0,1,116.48,0,6,6,0,0,0,3.39,3.51A57.77,57.77,0,0,1,226,127.83C226.08,158.58,200.21,185.2,169.5,186Z"></path></svg>
                    <p>Land</p>
                </a>
            </div>
        </div>
    </div>
    </body>
</html>