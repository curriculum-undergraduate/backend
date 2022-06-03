<!-- Left side (Sidebar) -->
<div id="bantu1" class="bg-white w-[350px] h-screen px-8 py-6 flex flex-col justify-between sidebar in-active">
    <!-- Top nav -->
    <div class="flex flex-col gap-y-6">
        <!-- Header -->
        <div class="flex items-center space-x-4 px-2">
            <img src="assets/icons/toggle_icons.svg" alt="toggle_dashboard" class="w-8 cursor-pointer" id="btnToggle">
            <img class="w-[150px] logo-gradit" src="assets/logo/logo_lumintu.png" alt="Logo">
        </div>
     <hr class="border-[1px] border-opacity-50 border-[#93BFC1]">
     <!-- List Menus -->
        <div>
            <ul class="flex flex-col gap-y-1">
                <li>
                    <?php if ($user->is_admin(Session::get('email')) || $user->is_mentor(Session::get('email'))) : ?>
                    <a href="dashboard.php"
                        class="flex items-center gap-x-4 h-[50px] rounded-xl px-4 hover:bg-cream text-dark-green hover:text-white">
                        <img class="w-5" src="assets/icons/home_icon.svg" alt="Dashboard Icon">
                        <p class="font-semibold">Beranda</p>
                    </a>
                    <?php else: ?>
                    <a href="home.php"
                        class="flex items-center gap-x-4 h-[50px] rounded-xl px-4 hover:bg-cream text-dark-green hover:text-white">
                        <img class="w-5" src="assets/icons/home_icon.svg" alt="Dashboard Icon">
                        <p class="font-semibold">Beranda</p>
                    </a>
                    <?php endif; ?>
                </li>
                <?php if ($user->is_mentor(Session::get('email'))) : ?>
                <li>
                    <a href="https://lessons.lumintulogic.com/auth.php?token=<?= $_SESSION['jwt'] ?>&expiry=<?php echo $_SESSION['expiry'] ?>"
                        class="flex items-center gap-x-4 h-[50px] rounded-xl px-4 hover:bg-cream text-dark-green hover:text-white">
                        <img class="w-5 fill-black" src="assets/icons/course_icon.svg" alt="Dashboard Icon">
                        <p class="font-semibold">Materi</p>
                    </a>
                </li>
                <li>
                    <a href="https://assignment.lumintulogic.com/auth.php?token=<?= $_SESSION['jwt']; ?>&expiry=<?= $_SESSION['expiry']; ?>&page=index"
                        class="flex items-center gap-x-4 h-[50px] rounded-xl px-4 hover:bg-cream text-dark-green hover:text-white">
                        <img class="w-5" src="assets/icons/attendance_icon.svg" alt="Dashboard Icon">
                        <p class="font-semibold">Penugasan</p>
                    </a>
                </li>

                <li>
                    <a href="https://consultation.lumintulogic.com/auth.php?token=<?= $_SESSION['jwt']; ?>&expiry=<?= $_SESSION['expiry']; ?>"
                        class="flex items-center gap-x-4 h-[50px] rounded-xl px-4 hover:bg-cream text-dark-green hover:text-white">
                        <img class="w-5" src="assets/icons/discussion_icon.svg" alt="Dashboard Icon">
                        <p class="font-semibold"> Konsultasi</p>
                    </a>
                </li> 
                <li>
                    <a href="https://schedule.lumintulogic.com/auth.php?token=<?= ($_SESSION['jwt']); ?>&expiry=<?= $_SESSION["expiry"]; ?>"
                        class="flex items-center gap-x-4 h-[50px] rounded-xl px-4 hover:bg-cream text-dark-green hover:text-white">
                        <img class="w-5" src="assets/icons/schedule_icon.svg" alt="Dashboard Icon">
                        <p class="font-semibold">Jadwal</p>
                    </a>
                </li>      
                <?php elseif (!$user->is_mentor(Session::get('email')) && !$user->is_admin(Session::get('email'))): ?>
                <li>
                    <a href="https://lessons.lumintulogic.com/auth.php?token=<?= $_SESSION['jwt']; ?>&expiry=<?= $_SESSION['expiry']; ?>"
                        class="flex items-center gap-x-4 h-[50px] rounded-xl px-4 hover:bg-cream text-dark-green hover:text-white">
                        <img class="w-5" src="assets/icons/course_icon.svg" alt="Dashboard Icon">
                        <p class="font-semibold">Materi</p>
                    </a>
                </li>
                <li>
                    <a href="https://assignment.lumintulogic.com/auth.php?token=<?= $_SESSION['jwt']; ?>&expiry=<?= $_SESSION['expiry']; ?>&page=index"
                        class="flex items-center gap-x-4 h-[50px] rounded-xl px-4 hover:bg-cream text-dark-green hover:text-white">
                        <img class="w-5" src="assets/icons/attendance_icon.svg" alt="Dashboard Icon">
                        <p class="font-semibold">Penugasan</p>
                    </a>
                </li>
                <li>
                    <a href="https://assignment.lumintulogic.com/auth.php?token=<?= $_SESSION['jwt']; ?>&expiry=<?= $_SESSION['expiry']; ?>&page=score"
                        class="flex items-center gap-x-4 h-[50px] rounded-xl px-4 hover:bg-cream text-dark-green hover:text-white">
                        <img class="w-5" src="assets/icons/score_icon.svg" alt="Dashboard Icon">
                        <p class="font-semibold">Nilai</p>
                    </a>
                </li>

                <li>
                    <a href="https://consultation.lumintulogic.com/auth.php?token=<?= $_SESSION['jwt']; ?>&expiry=<?= $_SESSION['expiry']; ?>"
                        class="flex items-center gap-x-4 h-[50px] rounded-xl px-4 hover:bg-cream text-dark-green hover:text-white">
                        <img class="w-5" src="assets/icons/discussion_icon.svg" alt="Dashboard Icon">
                        <p class="font-semibold"> Konsultasi</p>
                    </a>
                </li> 
                <li>
                    <a href="https://schedule.lumintulogic.com/auth.php?token=<?= ($_SESSION['jwt']); ?>&expiry=<?= $_SESSION["expiry"]; ?>"
                        class="flex items-center gap-x-4 h-[50px] rounded-xl px-4 hover:bg-cream text-dark-green hover:text-white">
                        <img class="w-5" src="assets/icons/schedule_icon.svg" alt="Dashboard Icon">
                        <p class="font-semibold">Jadwal</p>
                    </a>
                </li>      
                <?php endif; ?>                 
            </ul>
        </div>
    </div>
    <!-- Bottom nav -->
    <div>
        <ul class="flex flex-col ">
            <li>
                <a href="faq.php"
                    class="flex items-center gap-x-4 h-[50px] rounded-xl px-4 hover:bg-cream text-dark-green hover:text-white">
                    <img class="w-5" src="assets/icons/help_icon.svg" alt="Help Icon">
                    <p class="font-semibold">Bantuan</p>
                </a>
            </li>
            <li>
                <a href="logout.php" id="bantu2"
                    class="flex items-center gap-x-4 h-[50px] rounded-xl px-4 hover:bg-cream text-dark-green hover:text-white">
                    <img class="w-5" src="assets/icons/logout_icon.svg" alt="Log out Icon">
                    <p class="font-semibold">Keluar</p>
                </a>
            </li>
        </ul>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
