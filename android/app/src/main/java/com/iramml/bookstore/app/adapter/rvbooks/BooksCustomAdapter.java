package com.iramml.bookstore.app.adapter.rvbooks;

import android.content.Context;
import androidx.annotation.NonNull;
import androidx.recyclerview.widget.RecyclerView;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ImageView;
import android.widget.TextView;

import com.iramml.bookstore.app.model.Book;
import com.iramml.bookstore.app.R;
import com.squareup.picasso.Picasso;

import java.util.ArrayList;

public class BooksCustomAdapter extends RecyclerView.Adapter<BooksCustomAdapter.ViewHolder>{

    private Context context;
    private ArrayList<Book> items;
    private ClickListener listener;
    private ViewHolder viewHolder;

    public BooksCustomAdapter(Context context, ArrayList<Book> items, ClickListener listener ){
        this.context = context;
        this.items = items;
        this.listener = listener;
    }

    @NonNull
    @Override
    public ViewHolder onCreateViewHolder(@NonNull ViewGroup viewGroup, int i) {
        View view = LayoutInflater.from(context).inflate(R.layout.template_books,viewGroup,false);
        viewHolder = new ViewHolder(view, listener);
        return viewHolder;
    }

    @Override
    public void onBindViewHolder(@NonNull ViewHolder viewHolder, int i) {
        Picasso.get().load(items.get(i).getImageURL()).placeholder(R.drawable.placeholder).into(viewHolder.ivImage);
        viewHolder.tvTitle.setText(items.get(i).getTitle());
        viewHolder.tvAuthor.setText(items.get(i).getAuthor());
        viewHolder.tvCost.setText(String.format("$%s", items.get(i).getCost()));
    }

    @Override
    public int getItemCount() {
        return items.size();
    }

    class ViewHolder extends RecyclerView.ViewHolder implements View.OnClickListener{
        ImageView ivImage;
        TextView tvTitle, tvAuthor, tvCost;
        ClickListener listener;

        public ViewHolder(View itemView, ClickListener listener) {
            super(itemView);
            ivImage = itemView.findViewById(R.id.ivImage);
            tvTitle = itemView.findViewById(R.id.tvTitle);
            tvAuthor = itemView.findViewById(R.id.tvAuthor);
            tvCost = itemView.findViewById(R.id.tvCost);
            this.listener=listener;
            itemView.setOnClickListener(this);
        }

        @Override
        public void onClick(View view) {
            this.listener.onClick(view, getAdapterPosition());
        }
    }
}