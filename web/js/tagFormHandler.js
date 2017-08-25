var $collectionHolder

var $addTagLink = $("<a href=\"#\" class=\"add_tag_link btn\">Add a tag</a>")
var $newLinkLi = $("<li></li>").append($addTagLink)

$(document).ready(() => {
	$collectionHolder = $("ul.tags")

	// $collectionHolder.find("li").each(() => {
	// 	addTagFormDeleteLink($(this))
	// })
	
	$collectionHolder.append($newLinkLi)
	
	// count the current form inputs we have (e.g. 2), use that as the new index when inserting a new item
	$collectionHolder.data("index", $collectionHolder.find(":input").length)

	$addTagLink.on("click", (e) => {
		e.preventDefault()
		addTagForm($collectionHolder, $newLinkLi)
	})
})

function addTagForm($collectionHolder, $newLinkLi) {
	var prototype = $collectionHolder.data("prototype")
	var index = $collectionHolder.data("index")

	var newForm = prototype.replace(/__name__/g, index)

	$collectionHolder.data("index", index + 1)

	var $newFormLi = $("<li></li>").append(newForm)
	$newLinkLi.before($newFormLi)

	addTagFormDeleteLink($newFormLi)
}

function addTagFormDeleteLink($tagFormLi) {
	var $removeFormA = $("<a href=\"#\">Delete this tag</a>")
	$tagFormLi.append($removeFormA)

	$removeFormA.on("click", (e) => {
		e.preventDefault()
		$tagFormLi.remove()
	})
}