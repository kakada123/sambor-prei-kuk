<div class="ts-box ts-grid-content">
    <div class="head-color">
        <h3 class="title-color">
            <a href="#">@lang('app.the_visitor')</a>
        </h3>
    </div>
    <div class="ts-post-thumb">
        <div class="widgets">
            <ul class="category-list">
                <li>
                    <a href="#">@lang('app.online_visitor')
                        <span class="ts-green-bg">{{ $onlineVisitors ?? 0 }}
                            {{ trans_choice('app.visitor', $onlineVisitors ?? 0) }}</span>
                    </a>
                </li>
                <li>
                    <a href="#">@lang('app.today_visitor')
                        <span class="ts-blue-bg">{{ $todayVisitors ?? 0 }}
                            {{ trans_choice('app.visitor', $todayVisitors ?? 0) }}</span>
                    </a>
                </li>
                <li>
                    <a href="#">@lang('app.yesterday_visitor')
                        <span class="ts-yellow-bg">{{ $yesterdayVisitors ?? 0 }}
                            {{ trans_choice('app.visitor', $yesterdayVisitors ?? 0) }}</span>
                    </a>
                </li>
                <li>
                    <a href="#">@lang('app.all_visitor')
                        <span class="ts-pink-bg">{{ $allTimeVisitors ?? 0 }}
                            {{ trans_choice('app.visitor', $allTimeVisitors ?? 0) }}</span>
                    </a>
                </li>
            </ul>
        </div>

    </div>

</div>
