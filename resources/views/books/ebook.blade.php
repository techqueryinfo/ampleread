@extends('layouts.ebook-editor') @section('angularjs')
<link rel="stylesheet" href="/dist/textAngular.css" type="text/css">
<script src='/dist/angular.js'></script>
<script src='/dist/textAngular-rangy.min.js'></script>
<script src='/dist/textAngular-sanitize.min.js'></script>
<script src='/dist/textAngular.min.js'></script>
@endsection @section('content')
<form action="{{ url('/book/save') }}" method="POST" enctype="multipart/form-data">{{ csrf_field() }}
    <div class="user-bookcreateinfo" ng-cloak>
        <div class="info-left">
            <div class="row-one">
                <div class="unit-one active" data-tab="bookContent" ng-class="{ active: isSet(1) }">
                    <div class="content" ng-click="setTab(1)">Table of contents
                    </div>
                </div>
                <div class="unit-one" data-tab="bookInfo" ng-class="{ active: isSet(2) }">
                    <div class="content" ng-click="setTab(2)">
                        Book info
                    </div>
                </div>
                <div class="unit-one" data-tab="bookNotes" ng-class="{ active: isSet(3) }">
                    <div class="content" ng-click="setTab(3)">
                        Notes
                    </div>
                </div>
                <div class="unit-one" data-tab="bookImages" ng-class="{ active: isSet(4) }">
                    <div class="content" ng-click="setTab(4)">
                        Images
                    </div>
                </div>
            </div>
            <!-- first-->
            <div id="bookContent" ng-show="isSet(1)">
                <div class="row-two">
                    <div class="row-five" ng-click="addChapter()">
                        <button type="button">
                            <img src="/images/document-edit.png" alt="addnotes">Add Chapter
                        </button>
                    </div>
                    <div ng-repeat="chapter in chapters track by $index">
                        <div class="unit active" ng-click="viewChapter($index)">
                            <div class="first" ng-click="viewChapter($index)">@{{ chapter.name }}</div>
                            <div class="second" ng-click="deleteChapter($index)"><img src="/images/trash.png" alt="delete"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!--second-->
            <div id="bookInfo" class="book-section" ng-show="isSet(2)">
                <div class="row-three">
                    <div class="crate-switch">
                        <div class="text">Count Words Automatically</div>
                        <div class="switch">
                            <label class="switch">
                                <input type="checkbox" checked>
                                <span class="slider round"></span>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="row-four">
                    <div class="form-unit">
                        <div class="heading">eBook Title</div>
                        <div class="content">
                            <input type="text" placeholder="eBook Title" ng-model="ebooktitle"/>
                            <input type="hidden" name="book_id" value="@if(isset($book->id)){{ $book->id }}@endif"/>
                            <input type="hidden" name="bookContentID" value="@if(isset($bookContent->id)){{ $bookContent->id }}@endif"/>
                        </div>
                    </div>
                    <div class="form-unit">
                        <div class="heading">Sub Title</div>
                        <div class="content">
                            <input type="text" placeholder="Sub Title" ng-model="subtitle"/>
                        </div>
                    </div>
                    <div class="form-unit" style="margin: 0px 0px 10px 12px;">
                        <div class="heading">eBook Status Type</div>
                        <div class="content">
                            <select id="status" name="status">
                                <option value="1" @if($book->status === 1) selected="selected" @endif>Active</option>
                                <option value="0" @if($book->status === 0) selected="selected" @endif>Inactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-unit">
                        <div class="heading">Category</div>
                        <div class="content">
                            <!-- <select id="subcription" name="category">
                                @if(!$categories->isEmpty()) @foreach($categories as $val)
                                <option value="{{ $val->id }}" @if($val->id == $category->id) selected="selected" @endif>{{ $val->name }}</option>
                                @endforeach @endif
                            </select> -->
                            <!-- <select id="subcription" name="category" ng-repeat="x in category">
                                <option value="@{{x.id}}">@{{x.name}}</option>
                            </select> -->
                            <select id="subcription" ng-model="category">
                                <option ng-repeat="x in categories" value="@{{x.id}}"  ng-selected="@{{x.id == parseInt(category)}}">@{{x.name}}</option>
                            </select>
                            <!-- <pre>@{{category | json}}</pre> -->
                        </div>
                    </div>
                    <div class="form-unit">
                        <div class="heading">Description</div>
                        <div class="content">
                            <textarea ng-model="desc"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <!-- third-->
            <div id="bookNotes" class="book-section" ng-show="isSet(3)">
                <div class="row-five" ng-click="addNotes()">
                    <button type="button">
                        <img src="/images/document-edit.png" alt="addnotes">Add Note</button>
                </div>
                <div ng-repeat="note in notes track by $index">
                    <div class="row-six">
                        <div class="date">
                            <div class="time">Today, 15:47</div>
                            <div class="delete" ng-click="deleteNote($index)">
                                <img src="/images/trash.png" alt="delete">
                            </div>
                        </div>
                        <textarea name="notes[]">Enter Note...</textarea>
                    </div>
                </div>
            </div>
            <!-- forth -->
            <div id="bookImages" class="book-section" ng-show="isSet(4)">
                <div class="row-five">
                    <button type="button">
                        <img src="/images/upload.png" alt="upload">Upload image
                    </button>
                </div>
                <div class="row-seven">
                    <img src="/images/image1.jpg" alt="" />
                    <img src="/images/image3.jpg" alt="" />
                </div>
            </div>
        </div>
        <div class="info-right">
            <div class="text-header">
                <div class="thumb">
                    <div class="font-set">
                        <!-- <img src="images/group.png"> -->
                    </div>
                    <div class="font-set">
                        <!-- <img src="images/group.png"> -->
                    </div>
                </div>
                <div class="center-thumb">
                    <h1>Editor <span>@{{version}}</span></h1>
                    <div id="fontlinks">
                        <a href="#" id="incfont" ng-click="incfont()" class="button buttonfont">A+</a>
                        <a href="#" id="decfont" ng-click="decfont()" class="button buttonfont">A-</a>
                    </div>
                </div>
                <div class="close">
                    <i class="fas fa-times"></i>
                </div>
            </div>
            <div class="text-area">
                <div text-angular ng-model="htmlContent" ng-model-options="{ debounce: 500 }" ng-change="updateContent()" name="demo-editor" ta-text-editor-class="clearfix border-around container" ta-html-editor-class="border-around" ng-style="{'font-size': curSize + 'px'}"></div>
                <input type="text" name="chapters" value="@{{ chapters }}" style="visibility: hidden;" />
            </div>
            <div class="text-footer">
                <div class="publish">
                    <button type="button" ng-click="onClickGet()">Publish</button>
                </div>
                <div class="cancel">
                    <button type="button" ng-click="onClickPost()">Save</button>
                </div>
                <div class="preview">
                    <img src="/images/preview.png">
                </div>
                <label>Preview</label>
            </div>
        </div>
    </div>
</form>
@endsection @section('footer_scripts')
<script type="text/javascript">
    var app = angular.module('app', ['textAngular'])
    .config(function($provide) {
            // this demonstrates how to register a new tool and add it to the default toolbar
            $provide.decorator('taOptions', ['taRegisterTool', '$delegate', function(taRegisterTool, taOptions) { // $delegate is the taOptions we are decorating
                // add the button to the default toolbar definition
                taOptions.toolbar = [
                    ['h1', 'h2', 'h3', 'h4', 'h5']
                ];
                return taOptions;
            }]);
        });
    app.controller('TabController', ['$scope', 'textAngularManager', '$http', function($scope, textAngularManager, $http) {
        var book_id = <?php echo $book->id; ?>;
        $scope.tab = 1;
        $scope.setTab = function(newTab) {
            $scope.tab = newTab;
        };

        $scope.isSet = function(tabNum) {
            return $scope.tab === tabNum;
        };

        $scope.version = textAngularManager.getVersion();
        $scope.versionNumber = $scope.version.substring(1);
        $scope.chapters = [];
        $scope.activeChapterIndex = 0;
        $scope.counter = 0;
        $scope.notecounter = 0;
        $scope.notes   = [];
        $scope.values  = [];
        $scope.viewChapter = function(index) {
            $scope.htmlContent = $scope.chapters[index].content;
            $scope.activeChapterIndex = index;
        };

        $scope.addChapter = function() {
            $scope.counter++;
            const id      =  $scope.counter;
            const name    = 'Chapter ' + $scope.counter;
            const content = 'Enter content for '+ $scope.counter;
            $scope.chapters.push({ id, name, content });
        };
        $scope.updateContent = function() {
            const index = $scope.activeChapterIndex;
            if (!angular.isUndefined($scope.chapters[index])) {
                $scope.chapters[index].content = $scope.htmlContent;
            }
        };
        $scope.deleteChapter = function(index) {
            $scope.chapters.splice(index, 1);
        };

        $scope.addNotes = function() {
            $scope.notecounter++;
            const id   = $scope.notecounter;
            const name = 'Note '+ $scope.notecounter;
            $scope.notes.push({ id, name });
        };

        $scope.deleteNote = function(index) {
            $scope.notes.splice(index, 1);
        };

        $scope.addChapter();
        $scope.viewChapter(0);
        $scope.addNotes();
        $scope.onClickGet = function() {
            $http.get("book/get/"+book_id)
            .then(function successCallback(response){
                $scope.ebooktitle    = response.data.book.ebooktitle;
                $scope.subtitle      = response.data.book.subtitle;
                $scope.desc          = response.data.book.desc;
                $scope.status        = response.data.book.status;
                $scope.categories    = response.data.categories;
                $scope.category      = response.data.book.category;
                if(response.data.bookContent)
                    $scope.bookContentID = response.data.bookContent.id;
                else
                    $scope.bookContentID = undefined; 
                if(response.data.bookNote)
                    $scope.bookNoteID    = response.data.bookNote.id;
                else
                    $scope.bookNoteID    = undefined;
                console.log(response.data); console.log(response.data.category.id);
            }, function errorCallback(response){
                console.log("Unable to perform get request");
            });
        };  

        $scope.onClickPost = function() {
            alert('Post '+ book_id); 
            var data = {'id': book_id, 'ebooktitle': $scope.ebooktitle, 'subtitle': $scope.subtitle, 'category': parseInt($scope.category), 'status': $scope.status, 'desc': $scope.desc, 'chapters': $scope.chapters, 'notes': $scope.notes, 'bookContentID': $scope.bookContentID, 'bookNoteID': $scope.bookNoteID };
            $http.post("book/save", data)
            .then(function successCallback(response){
                console.log("Successfully POST-ed data "+ JSON.stringify(data));
                $scope.onClickGet();
            }, function errorCallback(response){
                console.log("POST-ing of data failed");
            });
        };
        $scope.onClickGet();
        $scope.curSize = 12;
        $scope.incfont = function(){
            $scope.curSize = parseInt($scope.curSize) + 2;
            console.log('curSize', $scope.curSize);
            if($scope.curSize<=20)
            {
                $scope.myObj = {
                    "font-size" : $scope.curSize+"px",
                }
            }
        }
        $scope.decfont = function(){
            $scope.curSize= parseInt($scope.curSize) - 2;
            console.log('curSize', $scope.curSize);
            if($scope.curSize>=12)
            {
                $scope.myObj = {
                    "font-size" : $scope.curSize+"px",
                }
            }
        }
    }]);
</script>
@endsection