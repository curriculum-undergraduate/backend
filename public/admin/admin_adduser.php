<?php


require_once '../config/function.php';
add_user_admin();

require_once '../inc/header.php';
require_once '../inc/sidebar.php';
require_once '../inc/footer.php';



$query = "SELECT * FROM user";
$results = mysqli_query($conn, $query);

?>
<body>

<div class="w-full max-w-xs mx-auto">
  <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" action="" method="POST">
    <div class="mb-4">
      <label class="block text-gray-700 text-sm font-bold mb-2" for="InputUsername">
        Username
      </label>
      <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="InputUsername"  name="username" placeholder="Username">
    </div>
    <div class="mb-4">
      <label class="block text-gray-700 text-sm font-bold mb-2" for="InputEmail">
        Email
      </label>
      <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="InputEmail"  name="email"  placeholder="Email">
    </div>
    <div class="mb-6">
      <label class="block text-gray-700 text-sm font-bold mb-2" for="InputPassword">
        Password
      </label>
      <input class="shadow appearance-none border border-red-500 rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="InputPassword" name="password" type="password" placeholder="******************">
      <p class="text-red-500 text-xs italic">Please choose a password.</p>
    </div>
    <div class="mb-6">
      <label class="block text-gray-700 text-sm font-bold mb-2" for="InputPassword">
        Password
      </label>
      <input class="shadow appearance-none border border-red-500 rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="InputConfirmPassword" name="confirm_password" type="password" placeholder="******************">
    </div>
    <div class="mb-6">
            <label for="role_id">Select user Role</label>
                <select class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline" name="role_id" id="role_id">
                    <option value="1">Admin</option>
                    <option value="2">Mentor</option>
                    <option value="3">Student</option>
                </select>
            </div>
    <div class="flex items-center justify-between">
      <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit" name="addUser">
        Sign In
      </button>
    </div>
  </form>
</div>
</body>