var app = new Vue({
	el: '#vue-app',

	data:{
		name: "Nikko",
		message: 'You loaded this page on ' + new Date().toLocaleString(),
		age: 28,
		website: "http://www.nikkozabala.com",
		websiteTag:"<a href='http://www.nikkozabala.com'>Nikko Website Again</a>",
		x:0,
		y:0,
		properyvalue:"",
		nn:"",
		aa:"test1",
		bb:"test",
	},

	methods:{
		greet: function(time="Morning")
		{
			return "Good " + time + " " + this.name
		},

		add: function()
		{
			this.age++;
		},

		subtract: function()
		{
			this.age--;
		},

		addWithNum: function(num)
		{
			this.age += num;
		},

		subWithNum: function(num)
		{
			this.age -= num;
		},

		updateXY: function(event)
		{

			this.x = event.offsetX;
			this.y = event.offsetY;
			// console.log(event);
		},

		alertMsg : function()
		{
			alert("No default pls");
		}
	}

});