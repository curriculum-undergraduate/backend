<!-- Left side (Sidebar) -->
<div class="bg-white w-[350px] h-screen px-8 py-6 flex flex-col justify-between sidebar in-active">
    <!-- Top nav -->
    <div class="flex flex-col gap-y-6">
        <!-- Header -->
        <div class="flex items-center space-x-4 px-2">
            <img src="assets/icons/toggle_icons.svg" alt="toggle_dashboard" class="w-8 cursor-pointer" id="btnToggle">
            <img class="w-[150px] logo-gradit" src="assets/logo/logo_primary.svg" alt="Logo In Career">
        </div>
     <hr class="border-[1px] border-opacity-50 border-[#93BFC1]">
     <!-- List Menus -->
        <div>
            <ul class="flex flex-col gap-y-1">
                <li>
                    <a href="dashboard.php"
                        class="flex items-center gap-x-4 h-[50px] rounded-xl px-4 hover:bg-cream text-dark-green hover:text-white">
                        <img class="w-5" src="assets/icons/home_icon.svg" alt="Dashboard Icon">
                        <p class="font-semibold">Dashboard</p>
                    </a>
                </li>
                <?php if ($user->is_admin(Session::get('email')) || $user->is_mentor(Session::get('email'))) : ?>
                    <li>                     
                        <a id="dropdownRightButton" data-dropdown-toggle="dropdownRight" data-dropdown-placement="right" type="button" class="flex items-center gap-x-4 h-[50px] rounded-xl px-4 hover:bg-cream text-dark-green hover:text-white">
                                <img class="w-5" src="assets/icons/consult_icon.svg" alt="Consult Icon">
                                <p class="font-semibold mr-[50px]">List User</p>
                                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg> 
                            </a>
                        <div id="dropdownRight" class="z-10 hidden bg-white divide-y divide-gray-100 rounded shadow w-44">
                        <ul class="py-1 text-sm text-white-700 font-semibold" aria-labelledby="dropdownRightButton">
                            <li>
                                <a href="users.php?role=student"
                                    class="flex items-center w-full p-2 text-base font-normal text-light-900 transition duration-75 rounded-lg hover:bg-cream text-dark-green hover:text-white pl-11">Student</a>
                            </li>
                            <li>
                                <a href="users.php?role=parents"
                                    class="flex items-center w-full p-2 text-base font-normal text-gray-900 transition duration-75 rounded-lg hover:bg-cream text-dark-green hover:text-white pl-11">Parents</a>
                            </li>
                            <li>
                                <a href="users.php?role=lecture"
                                    class="flex items-center w-full p-2 text-base font-normal text-gray-900 transition duration-75 rounded-lg hover:bg-cream text-dark-green hover:text-white pl-11">Lecture</a>
                            </li>
                            <li>
                                <a href="users.php?role=admin"
                                    class="flex items-center w-full p-2 text-base font-normal text-gray-900 transition duration-75 rounded-lg hover:bg-cream text-dark-green hover:text-white pl-11">Admin</a>
                            </li>
                        </ul>
                    </li>
             <?php endif; ?>
             <li>
                    <a href="http://schedule.lumintulogic.com/"
                        class="flex items-center gap-x-4 h-[50px] rounded-xl px-4 hover:bg-cream text-dark-green hover:text-white">
                        <img class="w-5" src="assets/icons/schedule_icon.svg" alt="Dashboard Icon">
                        <p class="font-semibold">Schedule</p>
                    </a>
                </li>
                <li>
                    <a href="http://lessons.lumintulogic.com/"
                        class="flex items-center gap-x-4 h-[50px] rounded-xl px-4 hover:bg-cream text-dark-green hover:text-white">
                        <img class="w-5 fill-black" src="assets/icons/course_icon.svg" alt="Dashboard Icon">
                        <p class="font-semibold">Lessons</p>
                    </a>
                </li>
                <li>
                    <a href="http://assignment.lumintulogic.com/"
                        class="flex items-center gap-x-4 h-[50px] rounded-xl px-4 hover:bg-cream text-dark-green hover:text-white">
                        <img class="w-5" src="assets/icons/attendance_icon.svg" alt="Dashboard Icon">
                        <p class="font-semibold">Assignment</p>
                    </a>
                </li>
                <li>
                    <a href="http://consultation.lumintulogic.com/"
                        class="flex items-center gap-x-4 h-[50px] rounded-xl px-4 hover:bg-cream text-dark-green hover:text-white">
                        <img class="w-5" src="assets/icons/discussion_icon.svg" alt="Dashboard Icon">
                        <p class="font-semibold"> Consultation</p>
                    </a>
                </li>                        
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
                    <p class="font-semibold">Help</p>
                </a>
            </li>
            <li>
                <a href="logout.php"
                    class="flex items-center gap-x-4 h-[50px] rounded-xl px-4 hover:bg-cream text-dark-green hover:text-white">
                    <img class="w-5" src="assets/icons/logout_icon.svg" alt="Log out Icon">
                    <p class="font-semibold">Log out</p>
                </a>
            </li>
        </ul>
    </div>
</div>