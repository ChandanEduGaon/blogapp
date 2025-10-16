@extends('admin.layout')
@section('content')
    <section class="h-full w-full grid grid-cols-9 gap-3 mt-3 overflow-y-auto ">
        <div class="col-span-2 flex w-full flex-col gap-3">
            <div class="bg-white w-full rounded-lg p-4 shadow-sm">
                @include('admin.sidebar')
            </div>
        </div>
        <div class="col-span-7 flex w-full flex-col gap-3">
            <div class="bg-white w-full rounded-lg p-4 gap-3 shadow-sm grid grid-cols-3 items-center justify-center">
                <div class="flex flex-col p-3 gap-3 rounded-lg shadow-lg">
                    <div class="flex justify-between items-center">
                        <div class="flex items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 576 512">
                                <rect width="576" height="512" fill="none" />
                                <path fill="#b5b5b5"
                                    d="M224 128a64 64 0 1 1 128 0a64 64 0 1 1-128 0m-48 208c0-61.9 50.1-112 112-112s112 50.1 112 112v8c0 13.3-10.7 24-24 24H200c-13.3 0-24-10.7-24-24zm216-192a56 56 0 1 1 112 0a56 56 0 1 1-112 0m27.2 100.4c9.1-2.9 18.8-4.4 28.8-4.4c53 0 96 43 96 96v10.7c0 11.8-9.6 21.3-21.3 21.3h-78.8c2.7-7.5 4.1-15.6 4.1-24v-8c0-34.1-10.6-65.7-28.8-91.6m-262.4 0c-18.2 26-28.8 57.5-28.8 91.6v8c0 8.4 1.4 16.5 4.1 24H53.3c-11.7 0-21.3-9.6-21.3-21.3V336c0-53 43-96 96-96c10 0 19.7 1.5 28.8 4.4M72 144a56 56 0 1 1 112 0a56 56 0 1 1-112 0M0 440c0-13.3 10.7-24 24-24h528c13.3 0 24 10.7 24 24s-10.7 24-24 24H24c-13.3 0-24-10.7-24-24"
                                    stroke-width="13" stroke="#b5b5b5" />
                            </svg>
                            <span class="text-xs">Total Users</span>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                            <rect width="24" height="24" fill="none" />
                            <g class="info-outline">
                                <g fill="#b5b5b5" class="Vector">
                                    <path fill-rule="evenodd"
                                        d="M22 12c0 5.523-4.477 10-10 10S2 17.523 2 12S6.477 2 12 2s10 4.477 10 10m-10 8a8 8 0 1 0 0-16a8 8 0 0 0 0 16"
                                        clip-rule="evenodd" />
                                    <path fill-rule="evenodd" d="M12 11a1 1 0 0 1 1 1v4a1 1 0 0 1-2 0v-4a1 1 0 0 1 1-1"
                                        clip-rule="evenodd" />
                                    <path d="M13 9a1 1 0 1 1-2 0a1 1 0 0 1 2 0" />
                                </g>
                            </g>
                        </svg>
                    </div>
                    <h1 class="text-2xl">{{$users ?? 0}}</h1>
                </div>
                <div class="flex flex-col p-3 gap-3 rounded-lg shadow-lg">
                    <div class="flex justify-between items-center">
                        <div class="flex items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                                <rect width="24" height="24" fill="none" />
                                <path fill="#b5b5b5"
                                    d="M8 5.5h8a3 3 0 0 0 3-3a.5.5 0 0 0-.5-.5h-13a.5.5 0 0 0-.5.5a3 3 0 0 0 3 3m8 13H8a3 3 0 0 0-3 3a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5a3 3 0 0 0-3-3"
                                    opacity="0.5" />
                                <path fill="#b5b5b5"
                                    d="M5 11.5c0-1.886 0-2.828.586-3.414S7.114 7.5 9 7.5h6c1.886 0 2.828 0 3.414.586S19 9.614 19 11.5v1c0 1.886 0 2.828-.586 3.414S16.886 16.5 15 16.5H9c-1.886 0-2.828 0-3.414-.586S5 14.386 5 12.5z" />
                            </svg>
                            <span class="text-xs">Total Posts</span>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                            <rect width="24" height="24" fill="none" />
                            <g class="info-outline">
                                <g fill="#b5b5b5" class="Vector">
                                    <path fill-rule="evenodd"
                                        d="M22 12c0 5.523-4.477 10-10 10S2 17.523 2 12S6.477 2 12 2s10 4.477 10 10m-10 8a8 8 0 1 0 0-16a8 8 0 0 0 0 16"
                                        clip-rule="evenodd" />
                                    <path fill-rule="evenodd" d="M12 11a1 1 0 0 1 1 1v4a1 1 0 0 1-2 0v-4a1 1 0 0 1 1-1"
                                        clip-rule="evenodd" />
                                    <path d="M13 9a1 1 0 1 1-2 0a1 1 0 0 1 2 0" />
                                </g>
                            </g>
                        </svg>
                    </div>
                    <h1 class="text-2xl">{{$posts ?? 0}}</h1>
                </div>
                <div class="flex flex-col p-3 gap-3 rounded-lg shadow-lg">
                    <div class="flex justify-between items-center">
                        <div class="flex items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 640 512">
                                <rect width="640" height="512" fill="none" />
                                <path fill="#b5b5b5"
                                    d="M208 352c114.9 0 208-78.8 208-176S322.9 0 208 0S0 78.8 0 176c0 38.6 14.7 74.3 39.6 103.4c-3.5 9.4-8.7 17.7-14.2 24.7c-4.8 6.2-9.7 11-13.3 14.3c-1.8 1.6-3.3 2.9-4.3 3.7c-.5.4-.9.7-1.1.8l-.2.2C1 327.2-1.4 334.4.8 340.9S9.1 352 16 352c21.8 0 43.8-5.6 62.1-12.5c9.2-3.5 17.8-7.4 25.2-11.4C134.1 343.3 169.8 352 208 352m240-176c0 112.3-99.1 196.9-216.5 207c24.3 74.4 104.9 129 200.5 129c38.2 0 73.9-8.7 104.7-23.9c7.5 4 16 7.9 25.2 11.4c18.3 6.9 40.3 12.5 62.1 12.5c6.9 0 13.1-4.5 15.2-11.1s-.2-13.8-5.8-17.9l-.2-.2c-.2-.2-.6-.4-1.1-.8c-1-.8-2.5-2-4.3-3.7c-3.6-3.3-8.5-8.1-13.3-14.3c-5.5-7-10.7-15.4-14.2-24.7c24.9-29 39.6-64.7 39.6-103.4c0-92.8-84.9-168.9-192.6-175.5c.4 5.1.6 10.3.6 15.5z"
                                    stroke-width="13" stroke="#b5b5b5" />
                            </svg>
                            <span class="text-xs">Total Comments</span>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                            <rect width="24" height="24" fill="none" />
                            <g class="info-outline">
                                <g fill="#b5b5b5" class="Vector">
                                    <path fill-rule="evenodd"
                                        d="M22 12c0 5.523-4.477 10-10 10S2 17.523 2 12S6.477 2 12 2s10 4.477 10 10m-10 8a8 8 0 1 0 0-16a8 8 0 0 0 0 16"
                                        clip-rule="evenodd" />
                                    <path fill-rule="evenodd" d="M12 11a1 1 0 0 1 1 1v4a1 1 0 0 1-2 0v-4a1 1 0 0 1 1-1"
                                        clip-rule="evenodd" />
                                    <path d="M13 9a1 1 0 1 1-2 0a1 1 0 0 1 2 0" />
                                </g>
                            </g>
                        </svg>
                    </div>
                    <h1 class="text-2xl">{{$comments ?? 0}}</h1>
                </div>
            </div>
        </div>
    </section>
@endsection
