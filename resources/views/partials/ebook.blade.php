<div class="admin-left">
    <div class="admin-img">
        @if (Auth::User() && (Auth::User()->profile) && (Auth::User()->profile->avatar_status == 0))
        <img src="{{ Gravatar::get(Auth::user()->email) }}"/>
        @else
        <img src="/uploads/{{ Auth::User()->profile->avatar }}"/>
        @endif
    </div>
    <div class="admin-name">
        <div class="name">{{Auth::user()->name}}<i class="fas fa-angle-down"></i></div>

    </div>
    <div class="admin-pro">
        <div class="admin-button"><a href="">Admin</a></div>
    </div>
    <div class="admin-line"></div>
    <div layout="column" class="admin-menu" ng-cloak>
        <ul>
            <li ng-class="{ active: isSet(1) }">
                <a href="#" ng-click="setTab(1)">TABLE OF CONTENTS</a>
            </li>
            <li ng-class="{ active: isSet(2) }">
                <a href="#" ng-click="setTab(2)">BOOK INFO</a>
            </li>
            <li ng-class="{ active: isSet(3) }">
                <a href="#" ng-click="setTab(3)">NOTES</a>
            </li>
            <li ng-class="{ active: isSet(4) }">
                <a href="#" ng-click="setTab(4)">IMAGES</a>
            </li>
        </ul>
        <div class="admin-line"></div>
        <div ng-show="isSet(1)">
            <div class="form-group" data-ng-repeat="choice in choices">
                <button ng-show="showAddChapter(choice)" ng-click="addNewChapter()"><i class="glyphicon glyphicon-plus"></i></button>
                <li><a href="#" ng-modal="@{{choice.id}}" ng-click="chapterContent(choice)">@{{choice.name}}</a></li>
                <button ng-click="removeNewChapter()"><i class="glyphicon glyphicon-trash"></i></button>
            </div>
        </div>
        <div ng-show="isSet(2)">
            <div class="admin-line"></div>
            <form>
                {{ csrf_field() }}
                <div>
                    <label for="ebook">E-Book Title</label>
                    <input type="text" id="ebook" name="ebooktitle" required="required" placeholder="E-Book title">
                </div>
                <div>
                    <label for="subtitle">Sub Title</label>
                    <input type="text" id="subtitle" name="subtitle" required="required" placeholder="Sub title">
                </div>
                <div>
                    <label for="type">Type</label>
                    <select name="type" id="type">
                        <option value="paid">Paid</option>
                        <option value="free">Free</option>
                    </select>
                </div>
                <div>
                    <label for="category">Category</label>
                    <select id="category" name="category">
                        @foreach($categories as $item)
                        <option value="{{ $item->category_slug }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="desc">Description</label>
                    <textarea id="desc" name="desc" placeholder="Enter Description..." required="required"></textarea>
                </div>
            </form>
        </div>
        <div ng-show="isSet(3)">
            <button class="btn btn-default">ADD NOTE</button>
        </div>
        <div ng-show="isSet(4)">
            <button class="btn btn-default">UPLOAD IMAGE</button>
        </div>
    </div>
    <!-- <div class="admin-line"></div> -->
    <div class="logout">
        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <div class="icon"><i class="fas fa-power-off"></i></div>
            <div class="text">Log out</div>
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>
    </div>
</div>