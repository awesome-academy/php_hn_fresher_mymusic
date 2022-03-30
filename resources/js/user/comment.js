import axios from "../admin/axios";
import trans from "../trans";
const _$ = document.querySelector.bind(document);
async function storeComment(e) {
    let form = $(e).parent();

    let resp = await axios.post("/comment", {
        song_id: form.find('input[name="song_id"]').val(),
        parent_id: form.find('input[name="parent_id"]').val(),
        user_id: form.find('input[name="user_id"]').val(),
        content: form.find('textarea[name="content"]').val(),
    });
    if (resp.status == 200) {
        form.find('textarea[name="content"]').val("");
        console.log(resp.data);
        renderComment(resp.data.comment);
    }
}
async function renderComment(comment) {
    let content = "";
    let replyContent = "";
    let parent = 0
    if (comment.parent_id == parent) {
        content = `
        <div class="comment-body-items">
            <div class="avatar-account">
                <img src="${comment.user.avatar}" alt="">
            </div>
            <div class="comment-content">
                <div class="name-account">${comment.user.full_name}</div>
                <div class="comment">${comment.content}</div>
                <div class="option option-comment">
                    <div class="option-left">
                        <a class="comment-reply">
                            <span class="reply-show">${trans.__("reply")}</span>
                        </a>
                    </div>
                </div>
                <div class="comment-form-mess reply-input" data-parent="${ comment.id}">
                    <form method="POST">
                        <input name="song_id" value="${comment.song_id}" hidden>
                        <input name="parent_id" value="${comment.id}" hidden>
                        <textarea class="message" placeholder="${trans.__("comment_content")}" name="content"></textarea>
                        <button type="button" class="send-mess-btn">
                            <i class="fa fa-paper-plane" aria-hidden="true"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
        `;
        $("#comment").prepend(content);
    } else {
        replyContent = `
        <div class="reply-list">
            <div class="reply-item">
                    <div class="avatar-account">
                    <img src="${comment.user.avatar}" alt="">
                    </div>
                    <div class="reply-items-content">
                        <div class="name-account">${comment.user.full_name}</div>
                        <div class="comment">${comment.content}</div>
                    </div>
                </div>
            </div>
        </div>`;
        $(`.reply-input[data-parent=${comment.parent_id}]`).append(
            replyContent
        );
    }
}

export default { storeComment };
