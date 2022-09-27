import formData from 'form-data';
import fs from 'fs';

const sendWebhook = async (url,data) => {
        const form = new formData();

        const fileName = '//home//thang//Desktop//1.jpg';

        form.append('file0', fs.readFileSync(fileName),fileName);

        form.append('payload_json', JSON.stringify(data));

        await axios.post(url, form);
}

sentWebhook('https://discord.com/api/webhooks/1023534227943329854/fbOpXN62DQLEych_cMvafl7iR_IotQLJ8LK8LNc9U6If2mQgosbmF2su6H6JNs5J0jP2',{
    username: "Captain Bot",
    content: 'Youtube'
})
