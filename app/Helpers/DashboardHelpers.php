<?php
    use Illuminate\Support\Facades\Route;

if (!function_exists('dashboardRoute')) {
    function dashboardRoute()
    {
        $user = \Illuminate\Support\Facades\Auth::user();
        if (!$user) {
            return route('login');
        }

        $roleToRoute = [
            'mahasiswa' => 'dashboard.userDashboard',
            'konselor'  => 'dashboard.counselorDashboard',
            'admin'     => 'dashboard.adminDashboard',
        ];

        $role = $user->getRoleNames()->first();
        return isset($roleToRoute[$role]) 
            ? route($roleToRoute[$role]) 
            : route('dashboard.userDashboard');
    }
}
?>