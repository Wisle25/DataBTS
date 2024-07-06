@extends('components.layout.index')
@section('content')
    <div>
        <h1 class="mx-4 text-base sm:text-lg md:text-3xl font-semibold text-gray-700 font-nunito mt-8">Informasi BTS</h1>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 p-4 gap-4">
            <div
                class="bg-violet-500 shadow-lg rounded-md flex items-center justify-between px-4 py-5 border-b-4 border-violet-700 text-white font-medium group">
                <div
                    class="flex justify-center items-center w-14 h-14 bg-white rounded-full transition-all duration-300 transform group-hover:rotate-12">
                    <svg width="30" height="30" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M16.2429 5.75732C18.586 8.10047 18.586 11.8995 16.2429 14.2426M7.75758 14.2426C5.41443 11.8995 5.41443 8.10047 7.75758 5.75732M4.92893 17.0711C1.02369 13.1658 1.02369 6.8342 4.92893 2.92896M19.0715 2.92896C22.9768 6.8342 22.9768 13.1658 19.0715 17.0711M12.0002 12C13.1048 12 14.0002 11.1046 14.0002 10C14.0002 8.89543 13.1048 8 12.0002 8C10.8957 8 10.0002 8.89543 10.0002 10C10.0002 11.1046 10.8957 12 12.0002 12ZM12.0002 12V21"
                            stroke="#7C3AED" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </div>
                <div class="text-right">
                    <p class="text-3xl">{{ $totalBTS }}</p>
                    <p>Jumlah BTS</p>
                </div>
            </div>
            <div
                class="bg-violet-500 shadow-lg rounded-md flex items-center justify-between px-4 py-5  border-b-4 border-violet-700 text-white font-medium group">
                <div
                    class="flex justify-center items-center w-14 h-14 bg-white rounded-full transition-all duration-300 transform group-hover:rotate-12">
                    <svg width="30" height="30" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M14 19.2857L15.8 21L20 17M4 21C4 17.134 7.13401 14 11 14C12.4872 14 13.8662 14.4638 15 15.2547M15 7C15 9.20914 13.2091 11 11 11C8.79086 11 7 9.20914 7 7C7 4.79086 8.79086 3 11 3C13.2091 3 15 4.79086 15 7Z"
                            stroke="#7C3AED" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </div>
                <div class="text-right">
                    <p class="text-3xl">{{ $totalPemilikBTS }}</p>
                    <p>Pemilik</p>
                </div>
            </div>
            <div
                class="bg-violet-500 shadow-lg rounded-md flex items-center justify-between px-4 py-5  border-b-4 border-violet-700 text-white font-medium group">
                <div
                    class="flex justify-center items-center w-14 h-14 bg-white rounded-full transition-all duration-300 transform group-hover:rotate-12">
                    <svg width="30" height="30" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg"
                        fill="none">
                        <path fill="#7C3AED" fill-rule="evenodd"
                            d="M8 0a8 8 0 100 16A8 8 0 008 0zm-.5 1.519a6.464 6.464 0 00-2 .48V5.19l2-1.09V1.518zM1.532 7.356A6.491 6.491 0 014 2.876V6.01L1.532 7.356zm.05 1.68L4 7.719v5.406a6.495 6.495 0 01-2.418-4.087zM7.5 11.423l-2 1.143V6.9l2-1.091v5.613zm1.5-.857V4.991L11 3.9v5.522l-2 1.143zm2 .585l-2 1.143v2.13a6.456 6.456 0 002-.655V11.15zm1.5 1.54v-2.397l1.887-1.079A6.488 6.488 0 0112.5 12.69zm0-4.125V3.31a6.482 6.482 0 011.976 4.126L12.5 8.565zm-5 4.585l-1.697.97a6.47 6.47 0 001.697.361V13.15zM9 3.282V1.576a6.455 6.455 0 011.961.636L9 3.282z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="text-right">
                    <p class="text-3xl">{{ $totalJenisBTS }}</p>
                    <p>Jenis BTS</p>
                </div>
            </div>
            <div
                class="bg-violet-500 shadow-lg rounded-md flex items-center justify-between px-4 py-5  border-b-4 border-violet-700 text-white font-medium group">
                <div
                    class="flex justify-center items-center w-14 h-14 bg-white rounded-full transition-all duration-300 transform group-hover:rotate-12">
                    <svg fill="#7C3AED" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink" width="30" height="30" viewBox="0 0 37.986 37.986"
                        xml:space="preserve">
                        <g>
                            <g>
                                <path
                                    d="M19.964,20.458c-2.258,0-4.096,1.837-4.096,4.097c0,2.258,1.837,4.096,4.096,4.096s4.097-1.838,4.097-4.096
                                                                                        C24.061,22.294,22.223,20.458,19.964,20.458z" />
                                <path
                                    d="M33.381,5.151c-0.408,0-0.798,0.083-1.152,0.232c-3.217-2.993-7.512-4.84-12.241-4.84c-5.723,0-10.82,2.694-14.119,6.87
                                                                                        C5.806,7.472,5.762,7.543,5.716,7.617c-1.771,2.308-2.99,5.051-3.475,8.043C0.956,15.994,0,17.154,0,18.542
                                                                                        s0.956,2.548,2.241,2.882c1.074,6.631,5.771,12.053,11.998,14.16v0.86c0,0.552,0.448,1,1,1h4.486c0.077,0,0.146-0.022,0.218-0.039
                                                                                        c0.075,0.018,0.146,0.039,0.224,0.039h4.522c0.553,0,1-0.448,1-1v-0.843c7.137-2.394,12.297-9.129,12.297-17.06
                                                                                        c0-3.127-0.803-6.068-2.211-8.633c0.369-0.497,0.594-1.106,0.594-1.771C36.369,6.492,35.029,5.151,33.381,5.151z M31.011,17.543
                                                                                        c-0.368-0.585-0.933-1.025-1.602-1.244c-0.165-2.616-0.617-5.035-1.294-7.161h2.461c0.414,1.155,1.508,1.988,2.804,1.988
                                                                                        c0.25,0,0.491-0.04,0.724-0.099c1.049,1.964,1.687,4.173,1.832,6.515L31.011,17.543L31.011,17.543z M25.46,29.332
                                                                                        c-0.183-0.23-0.454-0.386-0.771-0.386h-2.267c-0.519,0-0.95,0.396-0.996,0.913l-0.396,4.503c-0.102,0.032-0.203,0.077-0.307,0.1
                                                                                        v-4.516c0-0.552-0.449-1-1-1c-0.552,0-1,0.448-1,1v4.342c-0.118-0.045-0.235-0.089-0.351-0.146l-0.321-4.271
                                                                                        c-0.039-0.521-0.474-0.925-0.997-0.925h-1.817c-0.298,0-0.558,0.137-0.742,0.344c-1.135-2.63-1.871-6.036-1.985-9.747H25.54
                                                                                        c0.147,1.049,0.83,1.926,1.772,2.331C27.02,24.695,26.361,27.255,25.46,29.332z M5.791,17.543
                                                                                        c-0.271-0.757-0.833-1.372-1.557-1.707c0.424-2.473,1.415-4.749,2.837-6.697h3.398c0.196,0.547,0.543,1.016,0.996,1.363
                                                                                        c-0.55,2.13-0.882,4.507-0.953,7.041H5.791z M30.577,7.14h-3.19c-0.615-1.442-1.351-2.689-2.176-3.703
                                                                                        c2.076,0.72,3.954,1.854,5.544,3.307C30.688,6.871,30.627,7.001,30.577,7.14z M25.184,7.14h-9.105
                                                                                        c-0.15-0.42-0.381-0.802-0.691-1.111c1.281-2.166,2.883-3.485,4.601-3.485C21.982,2.543,23.824,4.316,25.184,7.14z M13.575,5.182
                                                                                        c-0.101-0.01-0.198-0.03-0.302-0.03c-1.295,0-2.39,0.833-2.804,1.988H8.784c1.676-1.646,3.714-2.917,5.979-3.703
                                                                                        C14.341,3.956,13.946,4.543,13.575,5.182z M13.379,11.117c1.249-0.044,2.296-0.854,2.698-1.978h9.922
                                                                                        c0.729,2.094,1.226,4.557,1.405,7.21c-0.6,0.235-1.103,0.656-1.44,1.194H12.512C12.583,15.25,12.885,13.069,13.379,11.117z
                                                                                        M4.234,21.25c0.724-0.335,1.286-0.95,1.557-1.707h4.722c0.154,5.537,1.566,10.327,3.725,13.4v0.514
                                                                                        C9.066,31.457,5.195,26.851,4.234,21.25z M25.689,33.474v-0.465c1.86-2.613,3.18-6.486,3.627-11.024
                                                                                        c1.113-0.324,1.951-1.271,2.117-2.441h4.504C35.54,25.919,31.402,31.285,25.689,33.474z" />
                            </g>
                        </g>
                    </svg>
                </div>
                <div class="text-right">
                    <p class="text-3xl">{{ $totalPIC }}</p>
                    <p>PIC</p>
                </div>
            </div>
            <div
                class="bg-violet-500 shadow-lg rounded-md flex items-center justify-between px-4 py-5  border-b-4 border-violet-700 text-white font-medium group">
                <div
                    class="flex justify-center items-center w-14 h-14 bg-white rounded-full transition-all duration-300 transform group-hover:rotate-12">
                    <svg fill="#7C3AED" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink" width="30" height="30" viewBox="0 0 31.203 31.203"
                        xml:space="preserve">
                        <g>
                            <g>
                                <g>
                                    <circle cx="8.286" cy="12.805" r="6.288" />
                                    <polygon
                                        points="15.782,20.683 10.714,20.039 8.395,22.818 5.999,20.039 0.45,20.683 0,31.163 16.102,31.163 			" />
                                </g>
                                <path d="M28.576,11.827v-0.584h-1.387v-1.08h-0.584v1.08H24.16v-1.08h-0.584v1.08H21.24v-1.08h-0.584v1.08h-2.372v-1.08H17.7v1.08
                                                                                            h-2.134c0.042,0.192,0.073,0.387,0.101,0.584H17.7v1.846h-2.004c-0.022,0.197-0.052,0.392-0.089,0.584H17.7v1.146h0.584v-1.146
                                                                                            h2.372v1.146h0.584v-1.146h2.335v1.146h0.584v-1.146h2.446v1.146h0.584v-1.146h1.387v-0.584h-1.387v-1.846H28.576z M20.656,13.672
                                                                                            h-2.372v-1.846h2.372V13.672z M23.576,13.672H21.24v-1.846h2.335L23.576,13.672L23.576,13.672z M26.605,13.672H24.16v-1.846h2.445
                                                                                            V13.672L26.605,13.672z" />
                                <path
                                    d="M25.875,0.625V0.041h-9.854v0.584H10.69v5.196c0.405,0.137,0.798,0.302,1.168,0.502V1.792h4.162v0.584h9.854V1.792h4.161
                                                                                            v14.1h-14.95c-0.185,0.41-0.404,0.801-0.657,1.168h16.775V0.625H25.875z" />
                                <path
                                    d="M28.463,6.924L25.73,8.079l-0.408-2.137l-2.016,1.498l-0.483-3.922l-1.88,3.268l-0.606-1.753l-1.224,2.782l-1.805-3.453
                                                                                            L13.89,7.954c0.129,0.146,0.251,0.298,0.369,0.455c0,0,0.001,0.001,0.001,0.002l2.907-3.055l1.99,3.807l1.112-2.53l0.539,1.556
                                                                                            l1.646-2.863l0.393,3.183l2.073-1.541l0.369,1.932l3.397-1.435L28.463,6.924z" />
                            </g>
                        </g>
                    </svg>
                </div>
                <div class="text-right">
                    <p class="text-3xl">{{ $totalSurveyor }}</p>
                    <p>Surveyor</p>
                </div>
            </div>
        </div>
    </div>
    <div>
        <h1 class="mx-4 mt-8 text-base sm:text-lg md:text-3xl font-semibold text-gray-700 font-nunito ">Kondisi BTS bulan
            ini</h1>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 p-4 gap-4">
            <div
                class="bg-teal-500 shadow-lg rounded-md flex items-center justify-between p-6 border-b-4 border-teal-700 text-white font-medium group">
                <div
                    class="flex justify-center items-center w-14 h-14 bg-white rounded-full transition-all duration-300 transform group-hover:rotate-12">
                    
                    <svg fill="rgb(20, 184, 166)" width="30" height="30" viewBox="0 -1.5 27 27"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="m24 24h-24v-24h18.4v2.4h-16v19.2h20v-8.8h2.4v11.2zm-19.52-12.42 1.807-1.807 5.422 5.422 13.68-13.68 1.811 1.803-15.491 15.491z" />
                    </svg>
                </div>
                <div class="text-right">
                    <p class="text-3xl">{{ $normalCount }}</p>
                    <p>Normal</p>
                </div>
            </div>
            <div
                class="bg-red-500 shadow-lg rounded-md flex items-center justify-between p-6 border-b-4 border-red-700 text-white font-medium group">
                <div
                    class="flex justify-center items-center w-14 h-14 bg-white rounded-full transition-all duration-300 transform group-hover:rotate-12">
                    <svg width="30" height="30" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2ZM12 7C12.5523 7 13 7.44772 13 8V12C13 12.5523 12.5523 13 12 13C11.4477 13 11 12.5523 11 12V8C11 7.44772 11.4477 7 12 7ZM11 16C11 15.4477 11.4477 15 12 15H12.01C12.5623 15 13.01 15.4477 13.01 16C13.01 16.5523 12.5623 17 12.01 17H12C11.4477 17 11 16.5523 11 16Z"
                            fill=" rgb(239, 68, 68)" />
                    </svg>
                </div>
                <div class="text-right">
                    <p class="text-3xl">{{ $faultCount }}</p>
                    <p>Fault</p>
                </div>
            </div>
            <div
                class="bg-yellow-500 shadow-lg rounded-md flex items-center justify-between p-6 border-b-4 border-yellow-700 text-white font-medium group">
                <div
                    class="flex justify-center items-center w-14 h-14 bg-white rounded-full transition-all duration-300 transform group-hover:rotate-12">
                    <svg fill="rgb(234, 179, 8)" width="30" height="30" viewBox="-1 0 19 19"
                        xmlns="http://www.w3.org/2000/svg" class="cf-icon-svg">
                        <path
                            d="M10.407 8.295H.695v-.448a1.112 1.112 0 0 1 1.109-1.108h8.252a3.678 3.678 0 0 0 .35 1.556zM.695 9.404h10.517q.071.066.145.129v4.626l-.074.003h-9.48a1.112 1.112 0 0 1-1.108-1.108zm1.758 3.188h3.819v-1.109h-3.82zM14.848 4.41a2.57 2.57 0 0 1 .156 4.552v5.269a1.27 1.27 0 0 1-2.539 0V8.96a2.578 2.578 0 0 1-.074-.043 2.567 2.567 0 0 1-1.226-2.18v-.011A2.57 2.57 0 0 1 12.62 4.41v1.923a.417.417 0 0 0 .416.415h1.396a.417.417 0 0 0 .415-.415V4.41z" />
                    </svg>
                </div>
                <div class="text-right">
                    <p class="text-3xl">{{ $maintenanceCount }}</p>
                    <p>Maintenance</p>
                </div>
            </div>
            <div
                class="bg-gray-500 shadow-lg rounded-md flex items-center justify-between p-6 border-b-4 border-gray-700 text-white font-medium group">
                <div
                    class="flex justify-center items-center w-14 h-14 bg-white rounded-full transition-all duration-300 transform group-hover:rotate-12">

                    <svg fill="rgb(107, 114, 128)" xmlns="http://www.w3.org/2000/svg" width="30" height="30"
                        viewBox="0 0 52 52" enable-background="new 0 0 52 52" xml:space="preserve">
                        <g>
                            <path d="M34.7,36.1c0.5-0.5,0.5-1.3,0-1.8l-1.8-1.8c-0.5-0.5-1.3-0.5-1.8,0l-4.4,4.4c-0.3,0.3-0.9,0.3-1.2,0
                                                l-4.4-4.4c-0.5-0.5-1.3-0.5-1.8,0l-1.8,1.8c-0.5,0.5-0.5,1.3,0,1.8l4.4,4.4c0.3,0.3,0.3,0.9,0,1.2l-4.4,4.4c-0.5,0.5-0.5,1.3,0,1.8
                                                l1.8,1.8c0.5,0.5,1.3,0.5,1.8,0l4.4-4.4c0.3-0.3,0.9-0.3,1.2,0l4.4,4.4c0.5,0.5,1.3,0.5,1.8,0l1.8-1.8c0.5-0.5,0.5-1.3,0-1.8
                                                l-4.4-4.4c-0.3-0.3-0.3-0.9,0-1.2L34.7,36.1z" />
                            <path
                                d="M47.7,11.6c-5.5-6.1-13.3-9.5-21.6-9.5S10,5.5,4.5,11.6C4.1,12,4.2,12.7,4.6,13l3,2.6C8,16,8.6,15.9,9,15.5
                                                c4.4-4.7,10.6-7.4,17.1-7.4s12.7,2.7,17.1,7.4c0.4,0.4,1,0.4,1.4,0.1l3-2.6C48,12.6,48.1,12,47.7,11.6z" />
                            <path
                                d="M26.1,16.1c-4.2,0-8.2,1.8-11,5c-0.4,0.4-0.3,1.1,0.1,1.5l3.2,2.4c0.4,0.3,1,0.3,1.3-0.1
                                                c1.7-1.8,4-2.8,6.4-2.8s4.7,1,6.3,2.7c0.3,0.4,0.9,0.4,1.3,0.1l3.2-2.4c0.5-0.4,0.5-1,0.1-1.5C34.3,17.9,30.3,16.1,26.1,16.1z" />
                        </g>
                    </svg>
                </div>
                <div class="text-right">
                    <p class="text-3xl">{{ $offlineCount }}</p>
                    <p>Offline</p>
                </div>
            </div>
            <div
                class="bg-blue-500 shadow-lg rounded-md flex items-center justify-between p-6 border-b-4 border-blue-700 text-white font-medium group">
                <div
                    class="flex justify-center items-center w-14 h-14 bg-white rounded-full transition-all duration-300 transform group-hover:rotate-12">
                    <svg width="30" height="30" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M4 12C4 7.58172 7.58172 4 12 4C13.6284 4 15.1432 4.48652 16.4068 5.32214L6.07523 17.3757C4.78577 15.9554 4 14.0694 4 12ZM7.59321 18.6779C8.85689 19.5135 10.3716 20 12 20C16.4183 20 20 16.4183 20 12C20 9.93057 19.2142 8.04467 17.9248 6.62436L7.59321 18.6779ZM12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2Z"
                            fill="rgb(59, 130, 246)" />
                    </svg>
                </div>
                <div class="text-right">
                    <p class="text-3xl">{{ $notYetMonitored }}</p>
                    <p>Not Yet</p>
                </div>
            </div>
        </div>
    </div>
@endsection
