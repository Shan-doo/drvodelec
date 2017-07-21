'use strict';

var Shuffle = window.shuffle;

// ES7 will have Array.prototype.includes.
function arrayIncludes(array, value) {
	return array.indexOf(value) !== -1;
}

// Convert an array-like object to a real array.
function toArray(thing) {
	return Array.prototype.slice.call(thing);
}

var Demo = function (element) {

	this.categories = toArray(document.querySelectorAll('.categories ul li a'));

	this.shuffle = new Shuffle(element, {
    speed: 450,
    easing: 'cubic-bezier(0.165, 0.840, 0.440, 1.000)', // easeOutQuart
    sizer: '.the-sizer',
});

	this.filters = {
		categories: []
	};

  this.likedImgs = this._getLikedImages();

  this.elements = this._getElements();

  this.elementsNum = this.elements.length;

  this.elementsPerPage = this.elements.length;

  this.loadedElementsNum = this.elementsPerPage;

  this._markLiked();

	this._bindEventListeners();

  this._bindEventListenersLikes();

};

/**
 * Bind event listeners for when the filters change.
 */
 Demo.prototype._bindEventListeners = function () {

 	this._onCategoryChange = this._handleCategoryChange.bind(this);

 	this.categories.forEach(function (button) {
 		button.addEventListener('click',this._onCategoryChange);
 	}, this);

 	document.querySelector('#load_more_imgs').addEventListener('click', this._loadMoreImages.bind(this));

 };

 Demo.prototype._bindEventListenersLikes = function() {

  //listeners for likes
  var hearts = document.getElementsByClassName('heart');
  
  if (hearts.length > 0) {

    // bind that to this since it will be bound to the icon and not the Demo obj in the addEventListener
    var that = this;

    /*console.log(this.elementsNum - this.loadedElementsNum);*/
   
    for (var i = this.elementsNum - this.loadedElementsNum; i < hearts.length; i++) {

      hearts[i].firstChild.addEventListener('click', function() {

        if (this.className === 'fa-heart-o') {

          this.className = 'fa-heart';

          this.nextSibling.innerHTML = parseInt(this.nextSibling.innerHTML) + 1;

          var likedImg = that._closestParent(this, '.gall').dataset.imageName;

          that.likedImgs.liked.push(likedImg);

          that._saveLikes(that.likedImgs);

        } else {

          this.className = 'fa-heart-o';

          this.nextSibling.innerHTML = parseInt(this.nextSibling.innerHTML) - 1;

          var likedImg = that._closestParent(this, '.gall').dataset.imageName;

          that.likedImgs.liked.splice(that.likedImgs.liked.indexOf(likedImg), 1);

          that._saveLikes(that.likedImgs);
        }

      })
    }
  }
 }

/**
 * Get the values of each `active` button.
 * @return {Array.<string>}
 */
 Demo.prototype._getCurrentCategoryFilter = function () {
 	return this.categories.filter(function (button) {
 		return button.classList.contains('selected');
 	}).map(function (button) {
 		return button.getAttribute('data-value');
 	});
 };

/**
 * A color button was clicked. Update filters and display.
 * @param {Event} evt Click event object.
 */
 Demo.prototype._handleCategoryChange = function (evt) {

 	var button = evt.currentTarget;

  // Treat these buttons like radio buttons where only 1 can be selected.
  if (button.classList.contains('selected')) {
  	button.classList.remove('selected');
  } else {
  	this.categories.forEach(function (btn) {
  		btn.classList.remove('selected');
  	});

  	button.classList.add('selected');
  }

  this.filters.categories = this._getCurrentCategoryFilter();
  
  this.filter();

  this._refreshPrettyPhoto();
};

/**
 * Filter shuffle based on the current state of filters.
 */
 Demo.prototype.filter = function () {
 	if (this.hasActiveFilters()) {
 		this.shuffle.filter(this.itemPassesFilters.bind(this));
 	} else {
 		this.shuffle.filter(Shuffle.ALL_ITEMS);
 	}
 };

/**
 * If any of the arrays in the `filters` property have a length of more than zero,
 * that means there is an active filter.
 * @return {boolean}
 */
 Demo.prototype.hasActiveFilters = function () {
 	return Object.keys(this.filters).some(function (key) {
 		return this.filters[key].length > 0;
 	}, this);
 };

/**
 * Determine whether an element passes the current filters.
 * @param {Element} element Element to test.
 * @return {boolean} Whether it satisfies all current filters.
 */
 Demo.prototype.itemPassesFilters = function (element) {

 	var categories = this.filters.categories;

 	var category = element.getAttribute('data-character').split(' ');

  var categoryLength = category.length;
 
  for (var i = 0; i < categoryLength; i++) {  

   if (categories.length > 0 && arrayIncludes(categories, category[i])) {

    return true;
    }
    
  }
  
  return false;
  };

  // If there are active color filters and this color is not in that array.
 /* if (categories.length > 0 && !arrayIncludes(categories, category)) {
  	return false;
  }

  return true;
  };*/

Demo.prototype._loadMoreImages = function () {

  document.getElementById('loaderAjaxProjects').style.display = 'block';

	this._numOfClicks++;

	var xhttp = new XMLHttpRequest();
	var images = [];
	var that = this;
	var offset = this._numOfClicks * this.elementsPerPage;

	xhttp.onreadystatechange = function() {

		if (this.readyState == 4 && this.status == 200) {
      
			var imagesRes = JSON.parse(this.responseText);

			for (var i = 0; i < imagesRes.length; i++) {

        var tempDiv = document.createElement('div');
        tempDiv.innerHTML = imagesRes[i];
        var newElement = tempDiv.firstChild
        images.push(newElement);
		  } 

      document.getElementById('loaderAjaxProjects').style.display = 'none';

  		that._addNewImages(images);

	   }

  };

xhttp.open("GET", "/?offset=" + offset + "&limit=" + that.elementsPerPage, true);

xhttp.send();

};

/**
 * Create some DOM elements, append them to the shuffle container, then notify
 * shuffle about the new items. You could also insert the HTML as a string.
 */
 Demo.prototype._addNewImages = function (images) {

 	images.forEach(function (image) {
 		this.shuffle.element.appendChild(image);
 	}, this);

  // Tell shuffle items have been appended.
  // It expects an array of elements as the parameter.
  this.shuffle.add(images);
  
  this.elements = this._getElements();

  this.elementsNum = this.elements.length;

  this.loadedElementsNum = images.length;

  this._refreshPrettyPhoto();

  this._refreshLikes();

};

Demo.prototype._refreshPrettyPhoto = function() {

  var visibleElements = $('.shuffle-item--visible')
                        .find("a[rel^='prettyPhoto']");

  visibleElements.prettyPhoto({animation_speed:'normal',theme:'light_square',slideshow:false, autoplay_slideshow: false, social_tools: ''});

};

Demo.prototype._refreshLikes = function() {

  this._bindEventListenersLikes();

  this._markLiked();

};

Demo.prototype._getLikedImages = function() {

  if (window.localStorage) {

    if (localStorage.getItem('likes') !== null) {
      
      return JSON.parse(localStorage.getItem('likes'));

    } else {

      localStorage.setItem('likes', '{"liked":[]}')

      return JSON.parse(localStorage.getItem('likes'));
    }

  } else {

    if (getCookie('likes') !== "") {

    return JSON.parse(getCookie('likes'));

    } else {

      document.cookie = 'likes={"liked":[]}';

      return JSON.parse(getCookie('likes'));
    }
  }
}

Demo.prototype._getCookie = function(cname) {

    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for(var i = 0; i <ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) === 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

Demo.prototype._saveLikes = function(obj) {

  if (window.localStorage) {

    localStorage.setItem('likes', JSON.stringify(obj))

  } else {

    document.cookie = "likes="+JSON.stringify(obj);
  }
}

Demo.prototype._closestParent = function(el, selector) {

    var matchesFn;

    // find vendor prefix
    ['matches','webkitMatchesSelector','mozMatchesSelector','msMatchesSelector','oMatchesSelector'].some(function(fn) {
        if (typeof document.body[fn] == 'function') {
            matchesFn = fn;
            return true;
        }
        return false;
    })

    var parent;

    // traverse parents
    while (el) {
        parent = el.parentElement;
        if (parent && parent[matchesFn](selector)) {
            return parent;
        }
        el = parent;
    }

    return null;
}

Demo.prototype._closestChild = function(el, selector) {

    var matchesFn;

    // find vendor prefix
    ['matches','webkitMatchesSelector','mozMatchesSelector','msMatchesSelector','oMatchesSelector'].some(function(fn) {
        if (typeof document.body[fn] == 'function') {
            matchesFn = fn;
            return true;
        }
        return false;
    })

    return el.querySelector(selector);
  
}

Demo.prototype._getElements = function() {

  return document.getElementsByClassName('gall');

}

Demo.prototype._markLiked = function() {

  var elementsLength = this.elements.length;

  for (var i = 0; i < elementsLength; i++) {
    
    /*var imgName = this.elements[i].dataset.imageName;*/
    
    this._closestChild(this.elements[i], '.fa-heart-o')
  
    if (this.likedImgs.liked.indexOf(this.elements[i].dataset.imageName) !== -1) {

      if (this._closestChild(this.elements[i], 'i.fa-heart-o') !== null) {

        this._closestChild(this.elements[i], 'i.fa-heart-o').className = 'fa-heart';
      }
    }
  }
}

Demo.prototype._numOfClicks = 0

document.addEventListener('DOMContentLoaded', function () {

	window.demo = new Demo(document.querySelector('.images'));

});