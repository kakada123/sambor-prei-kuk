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
                            {{ trans_choice('app.visitor', $online ?? 0) }}</span>
                    </a>
                </li>
                <li>
                    <a href="#">@lang('app.today_visitor')
                        <span class="ts-blue-bg">{{ $todayVisitors ?? 0 }}
                            {{ trans_choice('app.visitor', $todayVisitor ?? 0) }}</span>
                    </a>
                </li>
                <li>
                    <a href="#">@lang('app.yesterday_visitor')
                        <span class="ts-yellow-bg">{{ $yesterdayVisitors ?? 0 }}
                            {{ trans_choice('app.visitor', $yesterDay ?? 0) }}</span>
                    </a>
                </li>
                <li>
                    <a href="#">@lang('app.all_visitor')
<<<<<<< HEAD
                        <span class="ts-pink-bg">{{ $sixMonths ?? 0 }}
                            {{ trans_choice('app.visitor', $sixMonths ?? 0) }}</span>
=======
                        <span class="ts-pink-bg">{{ $sixMonthsVisitors ?? 0 }}
                            {{ trans_choice('app.visitor', $yesterDay ?? 0) }}</span>
>>>>>>> 7f2a4f0206a956790412a04a33507749210dfd68
                    </a>
                </li>
            </ul>
        </div>

    </div>

</div>
