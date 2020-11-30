<template>
    <div id="room_partner_detail">
        <div id="partner_label">取引相手</div>
        <div id="partner_name"><p>{{ partner.name }}</p></div>
        <div id="partner_image">
            <user-image
                :user_detail="partner.user_detail"
                :img_size="img_size"
            ></user-image>
        </div>
        <div id="partner_school">
            <p class="label">所属学校 </p>
            <p>{{ partner.school.name }}</p>
        </div>
        <div id="partner_course">
            <p class="label">所属コース </p>
            <p>{{ partner.course.name }}</p>
        </div>
        <div id="partner_profile_page">
            <a :href="'/home/user/' + partner.id">
                <img :src="'/images/icons/button/profile_button.png'">
                プロフィールへ</a>
        </div>
    </div>
</template>

<script>
    import UserImage from "../../../global/user-image";
    export default {
        name: "room-partner-detail",
        components: {UserImage},
        props: ['partner'],
        data() {
            return {
                img_size: {
                    height: "200px",
                    width: "200px",
                    objectFit: "cover",
                    verticalAlign: "bottom",
                }
            }
        }
    }
</script>

<style scoped>
    #room_partner_detail {
        width: 25%;
        padding: 30px;
        box-sizing: border-box;
    }

    #partner_label, #partner_image,
    #partner_school, #partner_course {
        margin-bottom: 30px;
    }

    #partner_label, #partner_name {
        text-align: center;
    }

    #partner_label {
        font-size: 2rem;
    }

    .label {
        font-size: 1.3rem;
        margin-bottom: 10px;
    }
    #partner_name {
        margin-bottom: 20px;
        font-size: 1.3rem;
    }
    #partner_image {
        height: 200px;
        width: 200px;
        margin-right: auto;
        margin-left: auto;
    }

    #partner_profile_page {
        width: fit-content;
        margin: 60px auto 0 auto;
    }
    #partner_profile_page a {
        font-size: 1.4rem;
        display: block;
        text-decoration: none;
        color: #fff;
        background-color: darkblue;
        padding: 20px;
        border-radius: 100px;
    }
    #partner_profile_page a img {
        height: 1.4rem;
        object-fit: cover;
        vertical-align: bottom;
    }
    #partner_profile_page:hover a {
        background-color: blue;
        transition: 0.2s ease-in;
    }
</style>
