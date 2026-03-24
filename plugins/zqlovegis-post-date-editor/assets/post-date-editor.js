(function () {
  const config = window.zqPostDateEditor;
  const root = document.getElementById('zq-post-date-editor-root');

  if (!config || !root) {
    return;
  }

  const labels = config.labels || {};

  function buildButton(postId) {
    const button = document.createElement('button');
    button.type = 'button';
    button.className = 'zq-post-date-trigger';
    button.dataset.postId = String(postId);
    button.textContent = labels.edit || '修改日期';
    return button;
  }

  function getDateCell(row) {
    return row.querySelector('td.date.column-date');
  }

  function closeEditor() {
    root.hidden = true;
    root.innerHTML = '';
  }

  async function request(action, payload) {
    const body = new URLSearchParams({
      action,
      nonce: config.nonce,
      ...payload
    });

    const response = await fetch(config.ajaxUrl, {
      method: 'POST',
      credentials: 'same-origin',
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'
      },
      body
    });

    return response.json();
  }

  async function openEditor(button) {
    const postId = button.dataset.postId;
    button.disabled = true;
    button.textContent = labels.loading || '读取中...';

    try {
      const result = await request('zq_get_post_date', { post_id: postId });

      if (!result.success) {
        throw new Error(result.data && result.data.message ? result.data.message : labels.error);
      }

      const data = result.data;
      root.hidden = false;
      root.innerHTML = `
        <div class="zq-post-date-editor-card">
          <div class="zq-post-date-editor-head">
            <strong>修改文章日期</strong>
            <button type="button" class="zq-post-date-close" aria-label="关闭">×</button>
          </div>
          <p class="zq-post-date-title">${data.title}</p>
          <label class="zq-post-date-field">
            <span>发布时间</span>
            <input type="datetime-local" value="${data.datetime}" />
          </label>
          <div class="zq-post-date-actions">
            <button type="button" class="button button-secondary zq-post-date-cancel">${labels.cancel || '取消'}</button>
            <button type="button" class="button button-primary zq-post-date-save">${labels.save || '保存'}</button>
          </div>
        </div>
      `;

      const panel = root.querySelector('.zq-post-date-editor-card');
      const input = root.querySelector('input');
      const save = root.querySelector('.zq-post-date-save');
      const cancel = root.querySelector('.zq-post-date-cancel');
      const close = root.querySelector('.zq-post-date-close');

      const closeAll = () => {
        closeEditor();
        button.disabled = false;
        button.textContent = labels.edit || '修改日期';
      };

      cancel.addEventListener('click', closeAll);
      close.addEventListener('click', closeAll);

      save.addEventListener('click', async () => {
        save.disabled = true;
        save.textContent = labels.saving || '保存中...';

        try {
          const updateResult = await request('zq_update_post_date', {
            post_id: postId,
            post_date: input.value
          });

          if (!updateResult.success) {
            throw new Error(updateResult.data && updateResult.data.message ? updateResult.data.message : labels.error);
          }

          window.location.reload();
        } catch (error) {
          window.alert(error.message || labels.error);
          save.disabled = false;
          save.textContent = labels.save || '保存';
        }
      });

      const row = document.getElementById(`post-${postId}`);
      const cell = row ? getDateCell(row) : null;

      if (cell) {
        const rect = cell.getBoundingClientRect();
        root.style.top = `${window.scrollY + rect.bottom + 8}px`;
        root.style.left = `${Math.max(window.scrollX + rect.left, 20)}px`;
      } else {
        root.style.top = `${window.scrollY + 120}px`;
        root.style.left = `${window.scrollX + 20}px`;
      }

      panel.querySelector('input').focus();
    } catch (error) {
      window.alert(error.message || labels.error);
      button.disabled = false;
      button.textContent = labels.edit || '修改日期';
    }
  }

  function injectButtons() {
    document.querySelectorAll('#the-list tr[id^="post-"]').forEach((row) => {
      const cell = getDateCell(row);

      if (!cell || cell.querySelector('.zq-post-date-trigger')) {
        return;
      }

      const postId = row.id.replace('post-', '');
      const wrapper = document.createElement('div');
      wrapper.className = 'zq-post-date-tools';
      wrapper.appendChild(buildButton(postId));
      cell.appendChild(wrapper);
    });
  }

  document.addEventListener('click', (event) => {
    const trigger = event.target.closest('.zq-post-date-trigger');

    if (trigger) {
      event.preventDefault();
      closeEditor();
      openEditor(trigger);
      return;
    }

    if (!root.hidden && !root.contains(event.target)) {
      closeEditor();
      document.querySelectorAll('.zq-post-date-trigger').forEach((button) => {
        button.disabled = false;
        button.textContent = labels.edit || '修改日期';
      });
    }
  });

  injectButtons();
})();
