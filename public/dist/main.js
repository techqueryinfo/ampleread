var app = angular.module('app', ['textAngular']);
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
    $scope.notes = [];
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
}]);