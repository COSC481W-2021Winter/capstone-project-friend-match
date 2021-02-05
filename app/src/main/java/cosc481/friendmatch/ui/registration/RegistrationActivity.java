package cosc481.friendmatch.ui.registration;


import android.app.Activity;
import android.os.Bundle;
import android.widget.TextView;

import androidx.appcompat.app.AppCompatActivity;
import cosc481.friendmatch.R;

public class RegistrationActivity extends AppCompatActivity {

    private TextView mTextView;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_registration);

        mTextView = (TextView) findViewById(R.id.text);
    }
}