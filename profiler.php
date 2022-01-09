<?php

$profilerTimeStart = microtime(true);

register_shutdown_function(function() use ($profilerTimeStart) {
    $profilerTimeEnd   = microtime(true);
    $extensionsLoaded  = get_loaded_extensions();
    $memoryUsage       = number_format((memory_get_usage(false) / 1024 / 1024), 3, '.', '.');
    $profilerTimeTotal = number_format($profilerTimeEnd - $profilerTimeStart, 3);

    echo '<style>

        #profiler * {
            box-sizing: border-box;
        }

        #profiler {
            transition: background-color 0.5s ease;
            background-color: rgba(48, 48, 48, 0.8);
            font-family: monospace;
            font-size: 12.5px;
            letter-spacing: -0.5px;
            width: 100%;
            height: 40px;
            line-height: 40px;
            position: fixed;
            bottom: 0;
            left: 0;
            z-index: 999999999;
        }

        #profiler:hover {
            background-color: rgba(38, 38, 38, 1);
        }

        #profiler .profiler-item {
            transition: border-color 0.5s ease;
            border-left: 1px solid rgba(113, 113, 113, 1);
            display: table-cell;
            padding: 0 15px;
            color: #BBB;
            cursor: pointer;
        }

        #profiler:hover .profiler-item {
            border-left: 1px solid rgba(73, 73, 73, 1);
        }

        #profiler .profiler-item:hover {
            background: rgba(53, 53, 53, 1);
        }

        #profiler .profiler-item span {
            color: #ededed;
            margin-left: 3px;
        }

        #profiler .profiler-item .profiler-popover {
            visibility: hidden;
            opacity: 0;
            position: absolute;
            bottom: 39px;
            transform: translateX(-15px);
            width: 148px;
            max-height: 320px;
            border: 1px solid #3A3A3A;
            border-bottom: 1px dashed #3A3A3A;
            border-radius: 5px;
            border-bottom-left-radius: 0;
            border-bottom-right-radius: 0;
            transition: 0.3s ease;
            background-color: #303030;
            padding: 10px 10px 5px;
            overflow-x: auto;
        }

        #profiler .profiler-item:hover .profiler-popover {
            visibility: visible;
            opacity: 1;
        }

        #profiler .profiler-popover div {
            border-bottom: 1px ridge #565656;
        }

        #profiler .profiler-popover div:last-child {
            border-bottom: 0;
        }

        #profiler .profiler-item:hover .profiler-popover:hover {
            overflow-y: scroll;
        }

        #profiler .profiler-item:hover .profiler-popover::-webkit-scrollbar {
            width: 7px;
        }

        #profiler .profiler-item:hover .profiler-popover::-webkit-scrollbar-track {
            -webkit-box-shadow: inset 0 0 5px rgba(0, 0, 0, 0.3);
        }

        #profiler .profiler-item:hover .profiler-popover::-webkit-scrollbar-thumb {
            background-color: #555;
            border-radius: 20px;
        }

    </style>

    <div id="profiler">
        <div class="profiler-item">PHP version: <span>' . phpversion() . '</span></div>
        <div class="profiler-item">PHP files: <span>' . count(get_included_files()) . '</span></div>
        <div class="profiler-item">HTTP status: <span>' . http_response_code() . '</span></div>
        <div class="profiler-item">HTTP method: <span>' . $_SERVER['REQUEST_METHOD'] . '</span></div>
        <div class="profiler-item">Loading time: <span>' . $profilerTimeTotal . ' s</span></div>
        <div class="profiler-item">Memory usage: <span>' . $memoryUsage . ' Mb</span></div>
        <div class="profiler-item">PHP Extensions: <span>' . count($extensionsLoaded) . '</span>
            <div class="profiler-popover">';
                foreach ($extensionsLoaded as $extension) {
                    echo '<div>' . $extension . '</div>';
                }
                echo '</div>
        </div>
    </div>';
});