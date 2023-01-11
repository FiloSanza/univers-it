<x-app-layout>
    <div class="text-center border-b-2 border-gray-600 p-3">
        <h1 class="font-bold text-2xl">
            Notifications
        </h1>
    </div>
    
    <section>
        <div class="text-center p-3 flex flex-col items-center">
            <h2> Unread Notifications </h2>
            <button 
                id='dlt-all' 
                class="my-1 mx-2 p-2 flex flex-row inline-block rounded-xl align-right bg-blue-100 hover:bg-gray-300 content-center"
            >
                Clear all
            </button>
        </div>
        <div id="unreadNotifications">
        </div>
    </section>

    <section>
        <div class="text-center p-3">
            <h2> Read Notifications </h2>
        </div>
        <div id="readNotifications">
        </div>
    </section>

</x-app-layout>