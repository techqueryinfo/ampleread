@extends('layouts.ebook-editor') @section('angularjs')
<script src='/dist/angular.js'></script>
<script src='/dist/ng-file-upload-shim.js'></script>
<script src='/dist/ng-file-upload.js'></script>
<script src='/dist/textAngular-rangy.min.js'></script>
<script src='/dist/textAngular-sanitize.min.js'></script>
<script src='/dist/textAngular.min.js'></script>
<script src='/dist/angular-spectrum-colorpicker.min.js'></script>
<script src='/dist/textAngular-dropdownToggle.js'></script>
<script src='/dist/spectrum.min.js'></script>
<link rel="stylesheet" href='/dist/textAngular.css' type="text/css"/>
<link rel="stylesheet" type="text/css" href='/dist/spectrum.min.css'/>
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
                            <div class="first" style="width: 90%" >
                                <input type="text" value="@{{ chapter.name }}" ng-model="chapter.name" ng-click="viewChapter($index)" style="width: 95%;" class="inputChapter">
                            </div>
                            <div class="second" ng-click="deleteChapter($index)" style="width: 10%"><img src="/images/trash.png" alt="delete"></div>
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
                            <select id="subcription" ng-model="category" ng-selected="category">
                                <option ng-repeat="x in categories" value="@{{x.id}}">@{{x.name}}</option>
                            </select>
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
                    <button type="button" data-toggle="modal" data-target="#uploadImageModal">
                        <img src="/images/upload.png" alt="upload">Upload image
                    </button>
                </div>
                <div class="row-seven">
                    <img ng-repeat="x in bookImages" src="/uploads/ebook_logo/@{{x.image}}" alt="" />
                </div>
            </div>
        </div>
        <div class="info-right">
            <div class="text-header">
                <div class="thumb">
                    <div class="font-set">
                        <img src="images/1.PNG">
                    </div>
                    <div id="color_picker" class="font-set">
                        <img src="images/group.png">
                    </div>
                </div>
                <div class="center-thumb">  
                </div>
                <div class="close">
                    <i class="fas fa-times"></i>
                </div>
            </div>
            <div class="text-area">
                <div text-angular ng-model="htmlContent" ng-model-options="{ debounce: 500 }" ng-change="updateContent()" name="demo-editor" ta-text-editor-class="clearfix border-around container" ta-html-editor-class="border-around" ng-style="myObj"></div>
                <input type="text" name="chapters" value="@{{ chapters }}" style="visibility: hidden;" />
            </div>
            <div class="text-footer">
                <div class="publish">
                    <button type="button" ng-click="onClickPost(2)">Publish</button>
                </div>
                <div class="cancel">
                    <button type="button" ng-click="onClickPost(0)">Save</button>
                </div>
                <div class="preview">
                    <a href="#" data-toggle="modal" data-target="#previewebookModal"><img src="/images/preview.png"></a>
                </div>
                <label>Preview</label>
            </div>
        </div>
    </div>
</form>
<div id="uploadImageModal" class="modal fade createbook-Modal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-text">eBook Image</div>
                <button type="button" class="close btnCls" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="ample-login-signup">
                    <div class="ample-login-section">
                        <form action="{{ url('/book/saveimage') }}" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="unit1">
                                <div class="form-group">
                                    <input type="hidden" name="user_id" value="{{ Auth::user()->id}}" />
                                </div>
                            </div>
                            <div class="unit2">
                                <input type="file" ngf-select ng-model="picFile" name="file"    
                                accept="image/*" ngf-max-size="2MB" required
                                ngf-model-invalid="errorFile">
                                <i ng-show="myForm.file.$error.required">*required</i><br>
                                <i ng-show="myForm.file.$error.maxSize">File too large @{{errorFile.size / 1000000|number:1}}MB: max 2M</i>
                            </div>
                            <div class="unit1">
                                <div class="form-group">
                                    <button type="button" class="submit-button" ng-click="uploadPic(picFile)">Upload Image</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>
<div class="color-picker" style="display: none;">
    <div class="arrow-up"></div>
    <div class="colorpicker-section">
        <div class="section-one">
            <div class="left">
                <div class="content">Font</div>
                <div class="select">
                    <select ng-model="font" ng-selected="font" ng-change="decfont()">
                        <option ng-repeat="x in fonts" value="@{{x.css}}">@{{x.name}}</option>
                    </select>
                </div>
            </div>
            <div class="right">
                <div class="content">Font Size</div>
                <div class="select">
                    <select ng-change="incfont()" ng-model="fontSize" ng-selected="fontSize">
                        <option value="10">10</option>
                        <option value="12">12</option>
                        <option value="14">14</option>
                        <option value="16">16</option>
                        <option value="18">18</option>
                        <option value="20">20</option>
                        <option value="22">22</option>
                        <option value="24">24</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="section-one">
            <div class="left newleft">
                <div class="content">Text Color</div>
                <div class="select">
                    <label class="checkbox-container">One
                        <input type="checkbox" checked="checked">
                        <span class="checkmark"></span>
                    </label>
                    <label class="checkbox-container">One
                        <input type="checkbox" checked="checked">
                        <span class="checkmark"></span>
                    </label>
                    <label class="checkbox-container">One
                        <input type="checkbox" checked="checked">
                        <span class="checkmark"></span>
                    </label>
                    <label class="checkbox-container">One
                        <input type="checkbox" checked="checked">
                        <span class="checkmark"></span>
                    </label>
                </div>
            </div>
            <div class="right newright">
                <div class="content">Background Color</div>
                <div class="select">
                    <label class="checkbox-container">One
                        <input type="checkbox" checked="checked">
                        <span class="checkmark"></span>
                    </label>
                    <label class="checkbox-container">One
                        <input type="checkbox" checked="checked">
                        <span class="checkmark"></span>
                    </label>
                    <label class="checkbox-container">One
                        <input type="checkbox" checked="checked">
                        <span class="checkmark"></span>
                    </label>
                    <label class="checkbox-container">One
                        <input type="checkbox" checked="checked">
                        <span class="checkmark"></span>
                    </label>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="previewebookModal" class="modal fade createbook-Modal ebook-preview-section" role="dialog">
<div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-text">PUBLISH EBOOK</div>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
              <div class="ebook-preview">
                  <div class="ebook-preview-row-one">
                      <div class="left">
                          <div class="image"><img src="/uploads/ebook_logo/@{{ebook_logo}}" alt="image" /></div>
                          <!-- <div class="button"><input type="submit" value="CHANGE COVER"></div> -->
                      </div>
                      <div class="right">
                          <div class="row">
                              <div class="heading">Category</div>
                              <div class="content">@{{categoryname}}</div>
                          </div>
                          <div class="row">
                              <div class="heading">File Size</div>
                              <div class="content">3.2605 KB</div>
                          </div>
                          <div class="row">
                              <div class="heading">Words</div>
                              <div class="content">10256</div>
                          </div>
                          <div class="row">
                              <div class="heading">Language</div>
                              <div class="content">English</div>
                          </div>
                      </div>
                  </div>
                  <div class="ebook-preview-row-two">
                      <div class="head-sec-two">@{{ebooktitle}}</div>
                      <div class="content-sec-two">
                        @{{desc}}
                      </div>
                      <div class="button-publish"><input type="button" ng-click="onClickPost(1)" value="PUBLISH"></div>
                  </div>
              </div>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>
@endsection @section('footer_scripts')
<script type="text/javascript">
    var app = angular.module('app', ['textAngular', 'ngFileUpload', 'angularSpectrumColorpicker', 'ui.bootstrap.dropdownToggle'])
    .config(function($provide) {
            // this demonstrates how to register a new tool and add it to the default toolbar
            $provide.decorator('taOptions', ['taRegisterTool', '$delegate', function(taRegisterTool, taOptions) { 
                taRegisterTool('backgroundColor', {
                    display: "<div spectrum-colorpicker ng-model='color' on-change='!!color && action(color)' format='\"hex\"' options='options'></div>",
                    action: function (color) {
                        var me = this;
                        if (!this.$editor().wrapSelection) {
                            setTimeout(function () {
                                me.action(color);
                            }, 100)
                        } else {
                            return this.$editor().wrapSelection('backColor', color);
                        }
                    },
                    options: {
                        replacerClassName: 'fa fa-paint-brush',
                        showButtons: false
                    },
                    color: "#fff"
                });
                taRegisterTool('fontColor', {
                    display: "<spectrum-colorpicker trigger-id='@{{trigger}}' ng-model='color' on-change='!!color && action(color)' format='\"hex\"' options='options'></spectrum-colorpicker>",
                    action: function (color) {
                        var me = this;
                        if (!this.$editor().wrapSelection) {
                            setTimeout(function () {
                                me.action(color);
                            }, 100)
                        } else {
                            return this.$editor().wrapSelection('foreColor', color);
                        }
                    },
                    options: {
                        replacerClassName: 'fa fa-font',
                        showButtons: false
                    },
                    color: "#000"
                });
                taRegisterTool('fontName', {
                    display: "<span class='bar-btn-dropdown dropdown'>" + "<button class='btn btn-blue dropdown-toggle' type='button' ng-disabled='showHtml()' style='padding-top: 4px'><i class='fa fa-font'></i><i class='fa fa-caret-down'></i></button>" + "<ul class='dropdown-menu'><li ng-repeat='o in options'><button class='btn btn-blue checked-dropdown' style='font-family: @{{o.css}}; width: 100%' type='button' ng-click='action($event, o.css)'><i ng-if='o.active' class='fa fa-check'></i>@{{o.name}}</button></li></ul></span>",
                    action: function (event, font) {
                    //Ask if event is really an event.
                    if (!!event.stopPropagation) {
                        //With this, you stop the event of textAngular.
                        event.stopPropagation();
                        //Then click in the body to close the dropdown.
                        $("body").trigger("click");
                    }
                    return this.$editor().wrapSelection('fontName', font);
                },
                options: [{
                    name: 'Sans-Serif',
                    css: 'Arial, Helvetica, sans-serif'
                }, {
                    name: 'Serif',
                    css: "'times new roman', serif"
                }, {
                    name: 'Wide',
                    css: "'arial black', sans-serif"
                }, {
                    name: 'Narrow',
                    css: "'arial narrow', sans-serif"
                }, {
                    name: 'Comic Sans MS',
                    css: "'comic sans ms', sans-serif"
                }, {
                    name: 'Courier New',
                    css: "'courier new', monospace"
                }, {
                    name: 'Garamond',
                    css: 'garamond, serif'
                }, {
                    name: 'Georgia',
                    css: 'georgia, serif'
                }, {
                    name: 'Tahoma',
                    css: 'tahoma, sans-serif'
                }, {
                    name: 'Trebuchet MS',
                    css: "'trebuchet ms', sans-serif"
                }, {
                    name: "Helvetica",
                    css: "'Helvetica Neue', Helvetica, Arial, sans-serif"
                }, {
                    name: 'Verdana',
                    css: 'verdana, sans-serif'
                }, {
                    name: 'Proxima Nova',
                    css: 'proxima_nova_rgregular'
                }]
            });
                taRegisterTool('fontSize', {
                    display: "<span class='bar-btn-dropdown dropdown'>" + "<button class='btn btn-blue dropdown-toggle' type='button' ng-disabled='showHtml()' style='padding-top: 4px'><i class='fa fa-text-height'></i><i class='fa fa-caret-down'></i></button>" + "<ul class='dropdown-menu'><li ng-repeat='o in options'><button class='btn btn-blue checked-dropdown' style='font-size: @{{o.css}}; width: 100%' type='button' ng-click='action($event, o.value)'><i ng-if='o.active' class='fa fa-check'></i> @{{o.name}}</button></li></ul>" + "</span>",
                    action: function (event, size) {
                    //Ask if event is really an event.
                    if (!!event.stopPropagation) {
                        //With this, you stop the event of textAngular.
                        event.stopPropagation();
                        //Then click in the body to close the dropdown.
                        $("body").trigger("click");
                    }
                    return this.$editor().wrapSelection('fontSize', parseInt(size));
                },
                options: [{
                    name: 'xx-small',
                    css: 'xx-small',
                    value: 1
                }, {
                    name: 'x-small',
                    css: 'x-small',
                    value: 2
                }, {
                    name: 'small',
                    css: 'small',
                    value: 3
                }, {
                    name: 'medium',
                    css: 'medium',
                    value: 4
                }, {
                    name: 'large',
                    css: 'large',
                    value: 5
                }, {
                    name: 'x-large',
                    css: 'x-large',
                    value: 6
                }, {
                    name: 'xx-large',
                    css: 'xx-large',
                    value: 7
                }]
            });
                // add the button to the default toolbar definition
                taOptions.toolbar = [
                    ['bold', 'italics','ul','justifyLeft', 'justifyCenter', 'justifyRight','insertLink','fontName', 'fontSize','backgroundColor', 'fontColor'],
                ];
                return taOptions;
            }]);
        });
    app.controller('TabController', ['$scope', 'textAngularManager', '$http', 'Upload', '$timeout',function($scope, textAngularManager, $http, Upload, $timeout) {
        var book_id = <?php echo $book->id; ?>;
        $scope.tab = 1;
        $scope.fonts = [{
            name: 'Sans-Serif',
            css: 'Arial, Helvetica, sans-serif'
        }, {
            name: 'Times New Roman',
            css: "'times new roman', serif"
        }, {
            name: 'Arial Black',
            css: "'arial black', sans-serif"
        }, {
            name: 'Arial Narrow',
            css: "'arial narrow', sans-serif"
        }, {
            name: 'Comic Sans MS',
            css: "'comic sans ms', sans-serif"
        }, {
            name: 'Courier New',
            css: "'courier new', monospace"
        }, {
            name: 'Garamond',
            css: 'garamond, serif'
        }, {
            name: 'Georgia',
            css: 'georgia, serif'
        }, {
            name: 'Tahoma',
            css: 'tahoma, sans-serif'
        }, {
            name: 'Trebuchet MS',
            css: "'trebuchet ms', sans-serif"
        }, {
            name: "Helvetica",
            css: "'Helvetica Neue', Helvetica, Arial, sans-serif"
        }, {
            name: 'Verdana',
            css: 'verdana, sans-serif'
        }, {
            name: 'Proxima Nova',
            css: 'proxima_nova_rgregular'
        }];
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
            console.log('ddddd', $scope.htmlContent);
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
                $scope.ebook_logo    = response.data.book.ebook_logo;
                $scope.categories    = response.data.categories;
                $scope.category      = response.data.book.category.toString();
                $scope.categoryname  = response.data.category.name;
                $scope.bookImages    = response.data.bookImages;
                if(response.data.bookContent)
                    $scope.bookContentID = response.data.bookContent.id;
                else
                    $scope.bookContentID = undefined; 
                if(response.data.bookNote)
                    $scope.bookNoteID    = response.data.bookNote.id;
                else
                    $scope.bookNoteID    = undefined;
                //console.log(response.data);
            }, function errorCallback(response){
                console.log("Unable to perform get request");
            });
        };  

        $scope.onClickPost = function(approve) {
            //alert('Book ID '+ book_id); 
            var data = {'id': book_id, 'ebooktitle': $scope.ebooktitle, 'subtitle': $scope.subtitle, 'category': parseInt($scope.category), 'status': approve, 'desc': $scope.desc, 'chapters': $scope.chapters, 'notes': $scope.notes, 'bookContentID': $scope.bookContentID, 'bookNoteID': $scope.bookNoteID };
            $http.post("book/save", data)
            .then(function successCallback(response){
                //console.log("Successfully POST-ed data "+ JSON.stringify(data));
                $scope.onClickGet();
                if(approve != undefined)
                {
                    window.location.replace('/home');
                }
            }, function errorCallback(response){
                console.log("POST-ing of data failed");
            });
        };
        $scope.onClickGet();
        $scope.fontSize = "14";
        $scope.font = "'arial narrow', sans-serif";
        $scope.incfont = function(){
            //console.log('fontSize', $scope.fontSize);
            $scope.myObj = {
                "font-size" : $scope.fontSize+"px",
                "font-family": $scope.font
            }
        };
        $scope.decfont = function(){
            //console.log('curSize', $scope.font);
            $scope.myObj = {
                "font-size" : $scope.fontSize+"px",
                "font-family": $scope.font
            }
        };

        $scope.uploadPic = function(file) {
            file.upload = Upload.upload({
              url: 'book/saveimage',
              data: {'book_id': book_id, 'ebook_image': file},
              method: 'POST'
            });
            file.upload.then(function (response) {
              $timeout(function () {
                file.result = response.data;
              }); $scope.onClickGet(); $('.btnCls').click();
            }, function (response) {
              if (response.status > 0)
                $scope.errorMsg = response.status + ': ' + response.data;
            }, function (evt) {
              // Math.min is to fix IE which reports 200% sometimes
              file.progress = Math.min(100, parseInt(100.0 * evt.loaded / evt.total));
            });
        };
    }]);
    //$("select").select2();
    $("#color_picker").on("click",function(){
        $(".color-picker").toggle();
    });
</script>
<style type="text/css">
.user-bookcreateinfo .info-right .text-area p{overflow-y:scroll;height:583px;font-size:auto;font-weight:normal;font-style:normal;font-stretch:normal;line-height:1.64;letter-spacing:normal;text-align:justify;color:#000}.btn-toolbar .btn, .btn-toolbar .btn-group, .btn-toolbar .input-group{float:none}.btn-default{color:#333;background-color:#fff;border:0px;margin-right:0px}.btn-toolbar{margin-left:18%;text-align:center;width:66%;margin-top:-5%}.sp-replacer{margin:0;overflow:hidden;cursor:pointer;padding:0px;display:inline-block;*zoom:1;*display:inline;border:0px;background:#eee;color:#333;vertical-align:middle}.sp-preview{width:15px;height:15px;border:solid 1px #222;margin-right:0px;float:left;z-index:0}span.btn{padding:6px 9px}
</style>
@endsection