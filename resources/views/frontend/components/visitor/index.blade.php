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
                        <span class="ts-green-bg">{{ $online ?? 0 }}
                            {{ trans_choice('app.visitor', $online ?? 0) }}</span>
                    </a>
                </li>
                <li>
                    <a href="#">@lang('app.today_visitor')
                        <span class="ts-blue-bg">{{ $todayVisitor ?? 0 }}
                            {{ trans_choice('app.visitor', $todayVisitor ?? 0) }}</span>
                    </a>
                </li>
                <li>
                    <a href="#">@lang('app.yesterday_visitor')
                        <span class="ts-yellow-bg">{{ $yesterDay ?? 0 }}
                            {{ trans_choice('app.visitor', $yesterDay ?? 0) }}</span>
                    </a>
                </li>
                <li>
                    <a href="#">@lang('app.all_visitor')
                        <span class="ts-pink-bg">{{ $sixMonths ?? 0 }}
                            {{ trans_choice('app.visitor', $sixMonths ?? 0) }}</span>
                    </a>
                </li>
            </ul>
        </div>

    </div>

</div>
