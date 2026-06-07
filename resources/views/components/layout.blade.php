<!DOCTYPE html>
<html lang="en" class = "h-full bg-gray-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Inventory</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.8/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body  class ="">

{{-- navbar --}}
<div class="navbar bg-base-100 shadow-sm">
  <div class="navbar-start">
    <div class="dropdown">
      <div tabindex="0" role="button" class="btn btn-ghost btn-circle">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"> <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7" /> </svg>
      </div>
      <ul
        tabindex="-1"
        class="menu menu-sm dropdown-content bg-base-100 rounded-box z-1 mt-3 w-52 p-2 shadow">
        <li><a href="/">Dashboard</a></li>
        <li><a href="/add-product">Add Product</a></li>
        <li><a href="/product-table">Product List</a></li>
        <li><a href="/purchase-product">Purchase Product</a></li>
        <li><a href="/activity-logs">Activity Logs</a></li>
        <li><a href="/purchase-history">Purchase History</a></li>
        <li><form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit"
                class="text-red-600 hover:text-red-800">
                Logout
            </button>
        </form>
        </li>
      </ul>
    </div>
  </div>
  <div class="navbar-center">
    <a class="btn btn-ghost text-xl">Inventory System</a>
  </div>
  <div class="navbar-end">

  </div>
</div>
    {{ $slot }}
</body>
</html>