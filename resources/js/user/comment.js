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
        renderComment(resp.data.comment);
    }
}
$(document).on("click", ".more-action", async function (e) {
    this.nextElementSibling.classList.toggle('active');
});

$(document).on("click", ".edit-mess-btn", async function (e) {
    let editForm =$(this).parent();
    let comment =  editForm.siblings('.comment');
    let resp = await axios.put('/comment/update', {
        'id' :  $(this).siblings('input[name=id]').val(),
        'content' : $(this).siblings('.message').val(),
    })
    if (resp.status == 200) {
        editForm.addClass('d-none');
        comment.removeClass('d-none');
        comment.html(resp.data.comment.content);
        $('.comment-more-action').removeClass('d-none');
        $('.comment-action').removeClass('active');
    }
});
$(document).on("click", ".comment-action-delete", async function (e) {
    let commenContent = $(this).parent().parent().siblings('.comment-content');
    let commentId = commenContent.children('.edit-comment').find('input[name=id]').val();
    let resp = await axios.delete('/comment/delete', {
        'id' :  commentId,
    })
    if (resp.status == 200) {
        $(`div[data-commentId='${commentId}']`).remove();
    }
});

$(document).on("click", ".comment-action-edit", async function (e) {
    let parent =$(this).parent().parent();
    let commentContent =  parent.siblings('.comment-content');
    let comment = commentContent.children('.comment');
    let editForm = commentContent.children('.edit-comment');
    comment.addClass('d-none')
    editForm.removeClass('d-none');
    parent.addClass('d-none');
    editForm.children('textarea').html(comment.html())
});

$(document).on("click", ".edit-close", async function (e) {
    let parent =$(this).parent().parent();
    parent.addClass('d-none');
    parent.siblings('.comment').removeClass('d-none');
    $('.comment-more-action').removeClass('d-none');
    $('.comment-action').removeClass('active');
});


async function renderComment(comment) {
    let content = "";
    let replyContent = "";
    let parent = 0
    if (comment.parent_id == parent) {
        content = `
        <div class="comment-body-items" data-commentId=${comment.id}>>
            <div class="avatar-account">
                <img src="${comment.user.avatar}" alt="">
            </div>
            <div class="comment-content">
                <div class="name-account">${comment.user.full_name}</div>
                <div class="comment">${comment.content}</div>
                <form class="d-none edit-comment" method="POST">
                    <input name="id" value="${comment.id}" hidden>
                    <textarea class="message" placeholder="" name="content" required> ${comment.content} </textarea>
                    <button type="button" class="edit-mess-btn">
                        <i class="fa-solid fa-xmark edit-close"></i>
                        <i class="fa fa-paper-plane" aria-hidden="true"></i>
                    </button>
                </form>
                <div class="option option-comment">
                    <div class="option-left">
                        <div class="comment-at">${trans.__('recent')}</div>
                        <a class="comment-reply">
                            <span class="reply-show">${trans.__("reply")}</span>
                        </a>
                    </div>
                </div>
                <div class="comment-form-mess reply-input" data-parent="${ comment.id}">
                    <form method="POST">
                        <input name="song_id" value="${comment.song_id}" hidden>
                        <input name="parent_id" value="${comment.id}" hidden>
                        <textarea class="message" placeholder="${trans.__("comment_content")}" name="content" required></textarea>
                        <button type="button" class="send-mess-btn">
                            <i class="fa fa-paper-plane" aria-hidden="true"></i>
                        </button>
                    </form>
                </div>
            </div>
            <div class="comment-more-action">
                <i class="more-action fa-solid fa-ellipsis-vertical"></i>
                <div class="comment-action">
                <div class="comment-action-edit"><span>${trans.__('update')}</span></div>
                <div class="comment-action-delete"><span>${trans.__('delete')}</span></div>
                </div>
            </div>
        </div>
        `;
        $("#comment").prepend(content);
    } else {
        replyContent = `
        <div class="reply-list active" data-commentId=${comment.id}>
            <div class="reply-item">
                <div class="avatar-account">
                    <img src="${comment.user.avatar}" alt="">
                </div>
                <div class="reply-items-content comment-content">
                    <div class="name-account">${comment.user.full_name}</div>
                    <div class="comment">${comment.content}</div>
                    <form class="d-none edit-comment" method="POST">
                        <input name="id" value="${comment.id}" hidden>
                        <textarea class="message" placeholder="${trans.__('comment_content')}" name="content" required>${comment.content}</textarea>
                        <button type="button" class="edit-mess-btn">
                            <i class="fa-solid fa-xmark edit-close"></i>
                            <i class="fa fa-paper-plane" aria-hidden="true"></i>
                        </button>
                    </form>
                    <div class="comment-at">${trans.__('recent')}</div>
                </div>
                <div class="comment-more-action">
                    <i class="more-action fa-solid fa-ellipsis-vertical"></i>
                    <div class="comment-action">
                        <div class="comment-action-edit"><span>${trans.__('update')}</span></div>
                        <div class="comment-action-delete"><span>${trans.__('delete')}</span></div>
                    </div>
                </div>
                </div>
            </div>
        </div>`;
        $(`.reply-input[data-parent=${comment.parent_id}]`).prepend(
            replyContent
        );
    }
}

export default { storeComment };
