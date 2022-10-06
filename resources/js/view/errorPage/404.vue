<template>
    <div class="container">
        <!-- 404 Error Text -->
        <div class="text-center">
            <div class="error mx-auto" data-text="404">404</div>
            <p class="lead text-gray-800 mb-5">Page Not Found</p>
            <p class="text-gray-500 mb-0">
                The page you were looking for was not found
            </p>
            <router-link :to="{ name: 'login' }"
                >&larr; Back To Dashboard</router-link
            >
        </div>
    </div>
</template>
