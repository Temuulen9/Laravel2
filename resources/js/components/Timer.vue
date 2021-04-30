<template>
<div>
    <p>
    {{ minute }} : {{ second }}
    </p>

</div>
</template>

<script>

    export default {
        
    props: {
        minute: {
            default: 19,
            type: Number
        }
    },
 
        data() {
            return {
                second: 59
            }
        },

        watch: {
            
            second: {
                handler(value) {
                    if (value > 0) {
                        setTimeout(() => {
                            this.second--;
                        }, 1000);
                    }
                    else if(this.minute > 0){
                        this.minute--;
                        this.second = 59;
                    }
                    else{
                        if(this.second > 0){
                            this.second--;
                        }
                        else{
                            window.location.href = '/test/exam';
                        }
                    }
                },
            
                immediate: true // This ensures the watcher is triggered upon creation
            }

        }
    }

</script>