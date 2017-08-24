$(document).ready(() => {
	
	$("#removeRedLineBtn").click(() => {
		if ($("#removeRedLineBtn").text() == "Remove red line") {
			$("tbody tr:nth-child(3)").hide()
			$("#removeRedLineBtn").text("Show red line")
		} else {
			$("tbody tr:nth-child(3)").show()
			$("#removeRedLineBtn").text("Remove red line")
		}
	})
	
	$("#getInfoBtn").click(() => {
		let name = $("#exampleName").val()
		let email = $("#exampleInputEmail1").val()
		let password = $("#exampleInputPassword1").val()
	
		$("#resultBox").html(`Name: ${name} <br> Email: ${email} <br> Password: ${password}`)
		$("#exampleName").val("")
		$("#exampleInputEmail1").val("")
		$("#exampleInputPassword1").val("")
	})
	
})