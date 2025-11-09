const advance_questions = document.querySelectorAll('.advance-question-holder');
const expand_question_list = document.querySelector('.expand-question-list');

if (expand_question_list && advance_questions.length) {
  expand_question_list.addEventListener('click', (e) => {
    const btn = e.target.closest('.limit-button');
    if (!btn) return;

    const limit = parseInt(btn.dataset.limit, 10);
    if (!limit) return;

    document.querySelectorAll('.limit-button').forEach(b => b.classList.remove('active-limit'));
    btn.classList.add('active-limit');

    advance_questions.forEach(q => q.hidden = true);

    for (let i = 0; i < limit && i < advance_questions.length; i++) {
      advance_questions[i].hidden = false;
    }
  });
}
