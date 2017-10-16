import { random, push, save } from './modules/message';
import { $on, qs } from './helpers';

const randomMessage = random();
setTimeout(() => {
  push(randomMessage, 'receiver');
}, 1000);
const messageForm = qs('#messages-form');
$on(messageForm, 'submit', (event) => {
  event.preventDefault();
  const messageInput = qs('.message-to-send', this);
  if (!messageInput) {
    return;
  }
  const messageValue = messageInput.value;
  save(messageValue).then((responseCode) => {
    if (responseCode === 201) {
      push(messageValue, 'sender');
    }
    messageInput.value = '';
  }).catch(() => {
    messageInput.value = '';
  });
});
