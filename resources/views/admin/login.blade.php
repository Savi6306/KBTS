<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

    <div class="min-h-screen flex items-center justify-center">
        <div class="bg-white shadow-lg rounded-lg p-8 w-full max-w-md">

            <h2 class="text-2xl font-bold mb-6 text-center text-blue-600">
                Admin Login
            </h2>

            <!-- ERROR Flash Message -->
            @if(session('error'))
                <div class="mb-4 p-3 bg-red-100 text-red-600 rounded">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Validation Errors -->
            @if ($errors->any())
                <div class="mb-4 p-3 bg-red-100 text-red-600 rounded">
                    <ul class="list-disc ml-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('admin.login.post') }}">
                @csrf

                <!-- Email -->
                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-1">Email</label>
                    <input type="email" name="email"
                        value="{{ old('email') }}"
                        class="w-full border border-gray-300 px-3 py-2 rounded focus:ring-2 focus:ring-blue-400"
                        placeholder="Enter Admin Email" required>
                </div>

                <!-- Password -->
                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-1">Password</label>
                    <input type="password" name="password"
                        class="w-full border border-gray-300 px-3 py-2 rounded focus:ring-2 focus:ring-blue-400"
                        placeholder="Enter Password" required>
                </div>

                <!-- Submit Button -->
                <button type="submit"
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 rounded mt-2 font-semibold">
                    Login
                </button>
            </form>

        </div>
    </div>

</body>
</html>
