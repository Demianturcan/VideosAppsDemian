<x-videos-app-layout>


    <div class="container mx-auto py-8">
        <h1 class="text-2xl font-bold mb-6">Notifications</h1>

        <div id="notifications-container" class="space-y-4">
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const container = document.getElementById('notifications-container');

            window.Echo.channel('videos')
                .listen('.video.created', (data) => {
                    const notification = document.createElement('div');
                    notification.className = 'bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded';
                    notification.innerHTML = `
                <p class="font-bold">New Video Created!</p>
                <p>${data.video.title}</p>`;
                    container.prepend(notification);
                });
        });
    </script>

</x-videos-app-layout>
