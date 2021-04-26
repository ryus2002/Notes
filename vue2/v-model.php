<html>
<head>
<body>
<div class="wrapper" id="app">
<form @submit.prevent="checkForm">
  <p>
    <auto-textarea v-model="info.activity_name"></auto-textarea>
  </p>
  <p>
    <input type="submit" value="Submit">  
  </p>
</form>
</div>

	
<script>
Vue.component('auto-textarea', {
	props:['txt'],
	data: function () {
		return {
      info: {
        activity_name:"test",
      },
      //txt:"test_txt",
		}
	},
	template: `
	<div class="flex-grow-1">
		<textarea>{{txt}}</textarea>
	</div>
	`,
	methods: {
	},
	watch: {
		txt: function() {
			//this.countdown = this.length_count-this.txt.length
		}
	},
	created() {
		//this.countdown = this.length_count-this.txt.length
	},
});

const app = new Vue({
  el:'#app',
  data:{
    info: {
      activity_name:null,
    }
  },
  methods:{
    checkForm:function(e) {
      alert(this.info.activity_name);
      alert(this.txt);
      e.preventDefault();
    }
  }
})
</script>
</body>
</html>

